<?php
use yii\helpers\Html;
?>

<style type="text/css">
    #wordsControls a{
        cursor: pointer;
    }
</style>

<fieldset id="wordsControls">
    <legend>Seasons/Episodes</legend>
    <? //echo Html::checkboxList('s_e', [], $this->context->episodes); ?>

    <ul class="controls">
        <li>
            <a class="selectAll">select all</a>
        </li>
        <li>
            <?php echo Html::checkbox('hard_only_cb', false, ['id' => 'hardOnlyChb', 'label' => 'Hard only']) ?>
        </li>
        <li>
            <?php echo Html::checkbox('super_hard_cb', false, ['id' => 'superHardChb', 'label' => 'Super hard']) ?>
        </li>
    </ul>

    <div id="episodesContainer">
    <?php
    foreach($this->context->episodes as $seasonNum => $seasonEpisodes){
        echo Html::checkboxList('s_e', [], $seasonEpisodes, ['class' => "chb-season season-{$seasonNum}"]);
    }
    ?>
    </div>
</fieldset>