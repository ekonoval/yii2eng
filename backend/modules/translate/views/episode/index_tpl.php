<?php
use backend\ext\Grid\BGridPjaxWidget;
use backend\ext\Grid\Columns\BActionColumn;
use backend\ext\System\BPjax;
use backend\modules\translate\models\Episode\BEpisodeSearch;
use backend\modules\translate\models\Movie\BMovieSearch;
use common\ext\Helpers\DateHelper;
use yii\grid\GridView;
use yii\helpers\Html;
use backend\ext\System\BackendController;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel BEpisodeSearch */

/** @var BackendController $ctrl */
$ctrl = $this->context;

$this->title = 'Episodes';

?>

<div class="product-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Create Episode', $ctrl->composeModuleUrl('create', 'episode', ['movieID' => $movieID]), ['class' => 'btn-sm btn-success']) ?>
    </p>

    <?php
    $pjaxGrid = new BGridPjaxWidget(
        $searchModel,
        $dataProvider,
        [
            'episodeID',
            //'seasonNum',
            [
                'attribute' => 'seasonNum',
                'filter' => $searchModel->getSeasonNumOptions()
            ],
            'episodeNum',

            [
                'attribute' => 'lnkWords',
                'value' => function ($data) use ($ctrl) {
                    return Html::a("[words]",
                        $ctrl->composeModuleUrl('index', 'word', ['episodeID' => $data->episodeID]),
                        ['data-pjax' => 0]
                    );
                },
                'contentOptions' => ['style' => 'width: 100px; text-align:center;'],
                'format' => 'raw'
            ],

            [
                'class' => BActionColumn::className(),
            ],
        ]
    );
    $pjaxGrid->run();
    ?>

</div>
