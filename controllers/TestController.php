<?php

namespace app\controllers;

use app\models\User;
use yii\web\Controller;

class TestController extends Controller
{
    public $layout = false;

    public function actionDb()
    {
        $users = User::find()->where(['id' => 1000])->all();
        var_dump($users);
        exit;
    }
}