<h2>import</h2>

<?php use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'importFile')->fileInput() ?>

<button>Submit</button>

<?php ActiveForm::end() ?>
