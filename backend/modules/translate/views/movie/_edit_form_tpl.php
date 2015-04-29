<?php

/* @var $this yii\web\View */
use backend\modules\translate\models\Movie\BMovieSave;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $model BMovieSave */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="edit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'movieName')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
