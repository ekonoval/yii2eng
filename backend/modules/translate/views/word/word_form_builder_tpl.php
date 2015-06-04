<?php
use kartik\builder\Form;
use kartik\form\ActiveForm;
use yii\helpers\Html;

//composer require --prefer-dist 'kartik-v/yii2-builder'

$form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);

echo Form::widget([
    'model' => $model,
    'form' => $form,
    //'columns' => 1,
    'attributes' => [
        'wordEN' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter notes...']],
        'wordRU' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter notes...']],
    ]
]);

echo Form::widget([
    'model' => $model,
    'form' => $form,
    'columns' => 6,
    'attributes' => [
        'isHard' => ['type' => Form::INPUT_CHECKBOX,],
        'superHard' => ['type' => Form::INPUT_CHECKBOX,],
    ]
]);


echo Html::button('Submit', ['type'=>'submit', 'class'=>'btn btn-primary']);
ActiveForm::end();