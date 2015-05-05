<?php
use yii\helpers\Html;
?>

<fieldset id="episodesContainer">
    <legend>Seasons/Episodes</legend>
    <? echo Html::checkboxList('s_e', [], $this->context->episodes); ?>
</fieldset>