<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var app\models\UploadImgForm $model
 */
?>
<div class="img-form-container">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form->field($model, 'imageFile')->fileInput() ?>

        <button class="btn btn-primary">Submit</button>

    <?php ActiveForm::end() ?>
    <a href=<?= Url::to(['index/profile'])?>>Back</a>
</div>