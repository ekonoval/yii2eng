<?php
use backend\ext\Grid\Columns\BooleanColumn;
use frontend\ext\Grid\FGridPjaxWidget;
use frontend\ext\System\FrontendController;
use frontend\modules\translate\controllers\MainController;
use frontend\modules\translate\ext\EpisodeIdsColumn;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var MainController $ctrl */
$ctrl = $this->context;
$wordsUrl = $ctrl->composeWordsUrl($movieID);
?>
<div class="translate-default-index">
    <h1>Words of ...</h1>

    <fieldset>
        <legend>Seasons/Episodes</legend>
        <?= Html::checkboxList('s_e', [], $episodes); ?>
    </fieldset>

    <?php
    $pjaxGrid = new FGridPjaxWidget(
        $searchModel,
        $dataProvider,
        [
            'wordEN',
            'wordRU',
            [
                'attribute' => 'isHard',
                'class' => BooleanColumn::className()
            ],
            [
                'attribute' => 'superHard',
                'class' => BooleanColumn::className()
            ],
            [
                'attribute' => 'episodeIds',
                'class' => EpisodeIdsColumn::className(),
                'value' => function ($model, $key, $index, $column) {
                    return $model->episodePlusSeasonString;
                }
            ]
        ],
        $wordsUrl
    );
    $pjaxGrid->run();
    ?>
</div>