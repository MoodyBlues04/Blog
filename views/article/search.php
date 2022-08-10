<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/**
 * @var SearchForm $model
 */
?>

<?php $form = ActiveForm::begin([
    'layout'=>'horizontal',
    'id' => 'search-form',
    'options' => ['class'=>'search-form'],
]); ?>

    <?= $form->field($model, 'textInput', ['enableLabel' => false])->textarea([
        'rows' => '1',
        'placeholder' => 'search..',
        'class'=>'form-control search-field'
    ]) ?>

    <?= Html::submitButton('search', [
        'class' => 'btn btn-primary search-button',
        'name' => 'search-button'
    ]) ?>
    
<?php ActiveForm::end(); ?>