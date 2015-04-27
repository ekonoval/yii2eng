<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = $data["title"];

?>
<div class="b-edit">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render($editFormViewPath, $data) ?>

</div>
