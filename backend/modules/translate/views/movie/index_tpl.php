<?php
use backend\ext\Grid\BGridPjaxWidget;
use backend\ext\System\BPjax;
use backend\modules\translate\models\Movie\BMovieSearch;
use common\ext\Helpers\DateHelper;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use backend\ext\System\BackendController;

/* @var $this yii\web\View */
/* @var $searchModel BMovieSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/** @var BackendController $ctrl */
$ctrl = $this->context;

$this->title = 'Movies';
?>

<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <? /* ?>
    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn-sm btn-success']) ?>
    </p>
    <? */ ?>

    <?php
    $pjaxGrid = new BGridPjaxWidget(
        $searchModel,
        $dataProvider,
        [
            'movieID',
            'movieName',
            [
                'attribute' => 'createDate',
                //'value' => 'created_at',
                'value' => function ($data) {
                    return DateHelper::getJqDatePickerFormatedDate($data->createDate, false);
                },
            ],

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

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
        ]
    );
    $pjaxGrid->run();
    ?>

</div>
