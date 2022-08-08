<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\assets\AppAsset;

$this->title = 'Log In';
AppAsset::register($this);

/**
 * @var app\models\LoginForm $model
 */
?>

<div class="login-form">
    <h1 style="margin-bottom: 20px"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username', ['enableLabel' => false])->textInput(['placeholder' => 'Name', 'class'=>'form-control text-center']) ?>
        <?= $form->field($model, 'password', ['enableLabel' => false])->passwordInput(['placeholder' => 'Password', 'class'=>'form-control text-center']) ?>
        
        <?= Html::submitButton('Login', ['class' => 'login-button btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>