<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

?>

<?php $form = ActiveForm::begin(['id' => 'downloadSourceCode']); ?>
    <?= $form->field($model, 'content')->textarea(['cols' => '20','rows' => '8']) ?>
    <?= Html::submitButton('Submit') ?>
<?php ActiveForm::end(); ?>
