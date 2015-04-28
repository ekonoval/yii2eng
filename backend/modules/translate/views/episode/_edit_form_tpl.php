<?php

/* @var $this yii\web\View */
use backend\modules\translate\models\Word\BWordSave;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $model BWordSave */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="edit-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'seasonNum')->textInput() ?>
    <?= $form->field($model, 'episodeNum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
