<?php

namespace app\controllers;

use app\models\Article;
use app\models\SearchForm;
use yii\web\Controller;
use app\models\ArticleForm;
use app\models\Logger;
use yii\data\Pagination;

class ArticleController extends Controller
{
    public $layout = '@app/views/layouts/home.php';

    public function actionCreate() 
    {
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
                (new Logger())->log('create article error', $e->getMessage(), __FILE__, \Yii::$app->user->identity->id);
                return $this->goHome();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * TODO Finds all articles with given tag
     * @param string $postInput
     */
    public function actionSearch($postInput = null)
    {
        $searchForm = new SearchForm();

        // TODO вместо $postInput
        /*if (!empty($_GET['postInput'])) {
            ...
        }*/

        if (null !== $postInput) {
            echo "not yet";exit;
        }

        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http')
            . '://'
            . $_SERVER['HTTP_HOST']
            . $_SERVER['REQUEST_URI'];

        if ($searchForm->load(\Yii::$app->request->post()) || stristr($url, '?page=')) {
            $query = Article::find();

            $pagination = new Pagination([
                'defaultPageSize' => 5,
                'totalCount' => $query->count(),
            ]);

            $articles = $query->orderBy(['created_at' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            return $this->render('search', [
                'model' => $searchForm,
                'articles' => $articles,
                'pagination' => $pagination,
            ]);
        }

        return $this->render('search', [
            'model' => $searchForm,
        ]);
    }

    /**
     * Shows article page
     * @param int $id article id
     * @return string
     */
    public function actionShow($id = null)
    {
        if (null === $id) {
            \Yii::$app->session->setFlash('error', "article's id unset");
            $id = \Yii::$app->user->isGuest ? null : \Yii::$app->user->identity->id;
            (new Logger())->log("article's id unset", null, __FILE__, $id);
            return $this->redirect(['/index/index']);
        }

        $article = Article::findOne(['id' => $id]);
        return $this->render('show', [
            'article' => $article,
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
        return \Yii::$app->response->redirect('/../index/index');
    }
}