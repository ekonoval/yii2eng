<?php
use frontend\ext\Grid\FGridPjaxWidget;
use frontend\ext\System\FrontendController;
use yii\helpers\Html;

/** @var FrontendController $ctrl */
$ctrl = $this->context;
?>
<div class="translate-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>

    <?php
    $pjaxGrid = new FGridPjaxWidget(
        $searchModel,
        $dataProvider,
        [
            'movieID',
            'movieName',

            [
                'attribute' => 'lnkEpisodes',
                'value' => function($data) use ($ctrl){
                    return Html::a("[episodes]",
                        $ctrl->composeModuleUrl('index', 'episode', ['movieID' => $data->movieID]),
                        ['data-pjax' => 0]
                    );
                },
                'contentOptions' => ['style' => 'width: 100px; text-align:center;'],
                'format' => 'raw'
            ],
        ]
    );
    $pjaxGrid->run();
    ?>
</div>