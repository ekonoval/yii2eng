<?php
use backend\ext\Grid\Columns\BooleanColumn;
use frontend\ext\Grid\FGridPjaxWidget;
use frontend\ext\System\FrontendController;
use frontend\modules\translate\controllers\MainController;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var MainController $ctrl */
$ctrl = $this->context;
$wordsUrl = $ctrl->composeWordsUrl($movieID);
?>
<div class="translate-default-index">
    <h1>Words of ...</h1>

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
                'attribute' => 'episodePlusSeasonString'
            ]
        ],
        $wordsUrl
    );
    $pjaxGrid->run();
    ?>
</div>