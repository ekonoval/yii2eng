<?php
use yii\helpers\Html;
$seasons = [];
if (!empty($this->context->episodes)) {
    $seasons = array_keys($this->context->episodes);
}
?>

<style type="text/css">
    #wordsControls a{
        cursor: pointer;
    }
    #wordsControls .controls li{
        display: inline-block;
    }
    #wordsControls .main-controls-last{
        margin-right: 20px;
    }

    #episodesContainer .chb-season{
        display: inline-block;
        margin-right: 20px;
        border-radius: 5px;
        border: 1px solid #cccccc;
    }

    #episodesContainer .season-1,
    #episodesContainer .season-3,
    #episodesContainer .season-5,
    #episodesContainer .season-7,
    #episodesContainer .season-9{
        background-color: #f7fdff;
        background-color: #ECF2F4;
        border: none;
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
        <li class="main-controls-last">
            <?php echo Html::checkbox('super_hard_cb', false, ['id' => 'superHardChb', 'label' => 'Super hard']) ?>
        </li>
        <?php foreach($seasons as $seasonNum):
        ?>
            <li>
                <?php echo Html::checkbox('season_cb', false, ['class' => 'seasonChb', 'data' => ['season' => $seasonNum], 'label' => "season {$seasonNum}"]) ?>
            </li>
        <?php endforeach; ?>

    </ul>

    <div id="episodesContainer">
    <?php
    foreach($this->context->episodes as $seasonNum => $seasonEpisodes){
        echo Html::checkboxList('s_e', [], $seasonEpisodes, ['class' => "chb-season season-{$seasonNum}"]);
    }
    ?>
    </div>
</fieldset>