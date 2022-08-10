<?php

namespace app\controllers;

use yii\base\Controller;
use app\models\ArticleForm;
use app\models\Logger;
use yii\helpers\Url;

class ArticleController extends Controller
{
    public $layout = '@app/views/layouts/home.php';

    public function actionCreate() {
        $flag = $this->isGuest();
        if (null !== $flag) {
            return $flag;
        }

        $model = new ArticleForm();

        if ($model->load(\Yii::$app->request->post())) {
            try {
                if ($model->validate() && $model->upload()) {
                    
                    return $this->goHome();
                } else {
                    throw new \Exception('saving error');
                }

            } catch (\Exception $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
                (new Logger())->log('create article error', $e->getMessage(), __FILE__, \Yii::$app->session->identity->id);
                return $this->goHome();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

        /**
     * Checks is user guest
     * 
     * @return null|string
     */
    public function isGuest() {
        if (\Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error', 'Log In to do that.');
            return $this->goHome();
        }
        return null;
    }

    /**
     * Redirects to home page
     * 
     * @return string
     */
    public function goHome() {
        return \Yii::$app->response->redirect(Url::to('index/index'));
    }
}