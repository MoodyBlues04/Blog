<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\User;
use app\models\UserData;
use app\models\Logger;
use app\models\SignupForm;
use app\models\LoginForm;
use app\models\UploadImgForm;
use app\modules\signup\SignupService;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class IndexController extends Controller
{

    public $layout = '@app/views/layouts/home.php';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Renders homepage
     * 
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Log in user
     * 
     * @return string
     */
    public function actionLogin()
    {
        // if (!\Yii::$app->user->isGuest) {
        //     return $this->goHome();
        // }

        $model = new LoginForm();
        
        if ($model->load(\Yii::$app->request->post())) {
            try {
                if($model->login()){
                    return $this->goHome();
                } 
            } catch (\Exception $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
                (new Logger())->log('log in error', $e->getMessage(), __FILE__);
                return $this->goHome();
            }
        }

        $model->password = '';

        $this->layout = 'login';
        return $this->render('login', [
            'model' => $model
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogOut()
    {
        try {
            \Yii::$app->user->logout();
        } catch (\Exception $e) {
            \Yii::$app->session->setFlash('error', $e->getMessage());
            (new Logger())->log('log out error', $e->getMessage(), __FILE__, \Yii::$app->user->identity->id);
        }
        return $this->goHome();
    }

    /**
     * Sign up new user
     * 
     * @return string
     */
    public function actionSignup()
    {        
        $form = new SignupForm();

        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
            $service = new SignupService();

            try {
                $user = $service->signup($form);
                \Yii::$app->session->setFlash('success', 'Check your email to confirm the registration.');
                $service->sentEmailConfirm($user);

                // echo "registered, check email";exit();
                return $this->goHome(); 
            } catch (\Exception $e) {
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', $e->getMessage());
                (new Logger())->log('sign up error', $e->getMessage(), __FILE__);
            }
            
            // echo "how";exit();
            return $this->goHome();
        }

        $this->layout = 'login';
        return $this->render('signup', [
            'model' => $form
        ]);
    }

    /**
     * Verifies confirm token
     * 
     * @return string
     */
    public function actionConfirm($token)
    {
        $service = new SignupService();
    
        // try{
            $service->confirmation($token);
            \Yii::$app->session->setFlash('success', 'You have successfully confirmed your registration.');
        // } catch (\Exception $e){
        //     \Yii::$app->errorHandler->logException($e);
        //     \Yii::$app->session->setFlash('error', $e->getMessage());
        //     (new Logger())->log('confirm error', $e->getMessage(), __FILE__);
        // }
    
        return $this->goHome();
    }

    /**
     * Renders profile page
     * 
     * @return string
     */
    public function actionProfile() {
        $flag = $this->isGuest();
        if (null !== $flag) {
            return $flag;
        }

        $model = User::getData();

        $path = UserData::getImgPath();
        return $this->render('profile', [
            'model' => $model,
            'path' => $path, 
        ]);
    }

    /**
     * Shows user's settings
     * 
     * @return strring
     */
    public function actionSettings() {
        $flag = $this->isGuest();
        if (null !== $flag) {
            return $flag;
        }


        return $this->render('settings');
    }

    /**
     * Changes user's data
     * 
     * @return string
     */
    public function actionEdit() {
        $flag = $this->isGuest();
        if (null !== $flag) {
            return $flag;
        }


        $username = \Yii::$app->user->identity->username;
        $user = User::findByUsername($username);
        $model = $user->userData;
        if (null === $model) {
            $model = new UserData();
            $model->auth_key = $user->auth_key;
        }

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('./profile');
        }
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    /**
     * Changes user's icon
     * 
     * @return string
     * @throws \Exception
     */
    public function actionUploadImg()
    {
        $flag = $this->isGuest();
        if (null !== $flag) {
            return $flag;
        }


        $model = User::getData();

        $form = new UploadImgForm();
        if (\Yii::$app->request->isPost) {
            $form->imageFile = UploadedFile::getInstance($form, 'imageFile');
            $link = $form->upload();
            if (null !== $link) {
                $model->image = $link;
                $model->save();
                return $this->redirect('./profile');
            }
            
            throw new \Exception('upload error');
        }

        $this->layout = 'login';
        return $this->render('upload-img', [
            'model' => $form,
        ]);
    }

    /**
     * Renders home page
     * 
     * @return string
     */
    public function goHome() {

        return $this->redirect(['index/index']);
    }

    /**
     * Checks is user guest
     * 
     * @return string
     */
    public function isGuest() {
        if (\Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error', 'Log In to do that.');
            return $this->goHome();
        }
        return null;
    }

    /**
     * Test action
     * 
     * @return string
     */
    public function actionTest() {
        $flag = $this->isGuest();
        if (null !== $flag) {
            return $flag;
        }


        echo \Yii::$app->user->Identity->username;
        try {
            \Yii::$app->user->logout();
        } catch (\Exception $e) {
            echo $e;
        }
    }

}