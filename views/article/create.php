<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var app\models\Article $model
 */

?>

<?php $form = ActiveForm::begin([
    'id' => 'article-form',
    'options' => ['class'=>'article-form'],
]); ?>

    <?= $form->field($model, 'header', ['enableLabel' => false])->textarea([
        'rows' => 2,
        'placeholder' => 'header',
        'class'=>'form-control text-center article-field'
    ]) ?>
    <?= $form->field($model, 'content', ['enableLabel' => false])->textarea([
        'rows' => 8,
        'placeholder' => 'article content',
        'class'=>'form-control text-center article-field'
    ]) ?>
    <?= $form->field($model, 'tags', ['enableLabel' => false])->textarea([
        'rows' => 1,
        'placeholder' => "enter tags input example: #tag1#tag2",
        'class'=>'form-control text-center article-field'
    ]) ?>

    <?= Html::submitButton('Publish', [
        'class' => 'btn btn-primary article-button',
        'name' => 'article-button'
    ]) ?>
    
<?php ActiveForm::end(); ?>
