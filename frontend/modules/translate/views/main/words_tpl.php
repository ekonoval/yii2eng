<?php
use backend\ext\Grid\Columns\BooleanColumn;
use frontend\ext\Grid\FGridPjaxWidget;
use frontend\ext\System\FrontendController;
use frontend\modules\translate\controllers\MainController;
use frontend\modules\translate\ext\EpisodeIdsColumn;
use frontend\modules\translate\ext\Grid\AjaxCheckboxColumn;
use frontend\modules\translate\ext\Grid\TranslationColumn;
use frontend\modules\translate\ext\Widgets\EpisodesFilter\EpisodesFilterWidget;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var MainController $ctrl */
$ctrl = $this->context;
$wordsUrl = $ctrl->composeWordsUrl($movieID);
?>

<style type="text/css">
    .td-transl{
        /*position: relative;*/
        width: 50%;
    }
    .td-transl .trChbShow{
        width: 20px;
        float: left;
    }
    .td-transl .trShowContent{
        float: left;
        width: 94%;
    }
</style>

<div class="translate-default-index">
    <h1>Words of ...</h1>

    <?php echo EpisodesFilterWidget::widget(['episodes' => $episodes]); ?>

    <?php
    $pjaxGrid = new FGridPjaxWidget(
        $searchModel,
        $dataProvider,
        [
            'wordEN',
            //'wordRU',
            [
                'attribute' => 'wordRU',
                'class' => TranslationColumn::className()
            ],
            [
                'attribute' => 'isHard',
                //'class' => BooleanColumn::className(),
                'class' => AjaxCheckboxColumn::className(),
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'hardOnlyFilter']
            ],
            [
                'attribute' => 'superHard',
                //'class' => BooleanColumn::className(),
                'class' => AjaxCheckboxColumn::className(),
                'modelKeyUpdate' => 'superHard',
                'action' => AjaxCheckboxColumn::ACTION_SUPER_HARD,
                'ajaxCheckboxGroupClass' => 'ajaxCbSuperHard',
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'superHardFilter'],
            ],
            [
                'attribute' => 'episodeIds',
                'class' => EpisodeIdsColumn::className(),
                'headerOptions' => ['style' => 'width: 40px;'],
                'contentOptions' => ['style' => 'text-align: center;'],
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