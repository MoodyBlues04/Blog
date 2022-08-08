<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\assets\AppAsset;

AppAsset::register($this);

/**
 * @var app\models\UserData $model
 */
?>

<div class="edit-form-container">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name')->textInput() ?>
        <?= $form->field($model, 'surname')->textInput() ?>
        <?= $form->field($model, 'gender')->dropDownList([
                '0' => 'male',
                '1' => 'female',
                '2'=> 'attack helicopter'
            ]);
        ?>
        <?= $form->field($model, 'introduction')->textarea(['rows' => '6'])?>
        <?= Html::submitButton('Save', ['class' => 'login-button btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>



