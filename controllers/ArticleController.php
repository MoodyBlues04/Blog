<?php

namespace app\controllers;

use yii\base\Controller;
use app\models\Article;

class ArticleController extends Controller
{
    public $layout = '@app/views/layouts/home.php';

    public function actionIndex() {
        $model = new Article();
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}