<?php

use backend\ext\User\BUserRbac;
use backend\models\BackUser;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model BackUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>
<? /* ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'pwd')->passwordInput() ?>

    <?= $form->field($model, 'role')->dropDownList(BUserRbac::getRolesList(), ['prompt' => '--select role--']) ?>
    <?= $form->field($model, 'status')->dropDownList($model->statusesList(), ['prompt' => '--select status--']) ?>
<? */ ?>

    <?= $form->field($model, 'wordEN')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'wordRU')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'isHard')->checkbox() ?>
    <?= $form->field($model, 'superHard')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
