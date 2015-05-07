<?php
use backend\ext\Grid\Columns\BooleanColumn;
use frontend\ext\Grid\FGridPjaxWidget;
use frontend\ext\System\FrontendController;
use frontend\modules\translate\controllers\MainController;
use frontend\modules\translate\ext\EpisodeIdsColumn;
use frontend\modules\translate\ext\Widgets\EpisodesFilter\EpisodesFilterWidget;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var MainController $ctrl */
$ctrl = $this->context;
$wordsUrl = $ctrl->composeWordsUrl($movieID);
?>
<div class="translate-default-index">
    <h1>Words of ...</h1>

    <?php echo EpisodesFilterWidget::widget(['episodes' => $episodes]); ?>

    <?php
    $pjaxGrid = new FGridPjaxWidget(
        $searchModel,
        $dataProvider,
        [
            'wordEN',
            'wordRU',
            [
                'attribute' => 'isHard',
                'class' => BooleanColumn::className(),
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'hardOnlyFilter']
            ],
            [
                'attribute' => 'superHard',
                'class' => BooleanColumn::className(),
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'superHardFilter']
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
    //$pjaxGrid->customHtml = "seed: " . $searchModel->curentRandSeed;
    $pjaxGrid->run();
    ?>
</div>