<?php

use backend\modules\auth\models\AdminCrud\AdminCrudSave;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model AdminCrudSave */

$this->title = 'Update Product: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, /*'url' => ['view', 'id' => $model->id]*/];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'roles' => $roles,
    ]) ?>

</div>
