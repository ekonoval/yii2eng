<?php

use backend\models\BackUser;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model BackUser */

$this->title = 'Create Admin';
$this->params['breadcrumbs'][] = ['label' => 'Admins List', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'roles' => $roles,
    ]) ?>

</div>
