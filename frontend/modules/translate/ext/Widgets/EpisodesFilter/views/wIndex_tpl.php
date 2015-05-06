<?php
use yii\helpers\Html;
?>

<style type="text/css">
    #episodesContainer a{
        cursor: pointer;
    }
</style>

<fieldset id="episodesContainer">
    <legend>Seasons/Episodes</legend>
    <? //echo Html::checkboxList('s_e', [], $this->context->episodes); ?>

    <ul class="controls">
        <li>
            <a class="selectAll">select all</a>
        </li>
    </ul>

    <?php
    foreach($this->context->episodes as $seasonNum => $seasonEpisodes){
        echo Html::checkboxList('s_e', [], $seasonEpisodes, ['class' => "chb-season season-{$seasonNum}"]);
    }
    ?>
</fieldset>