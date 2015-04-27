<?php
use backend\ext\Grid\BGridPjaxWidget;
use backend\ext\System\BPjax;
use backend\modules\translate\controllers\TranslateController;
use backend\modules\translate\models\Word\BWordSearch;
use backend\ext\Grid\Columns\BooleanColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel BWordSearch */

/** @var TranslateController $ctrl */
$ctrl = $this->context;

$this->title = "{$title} words";
$episodeID = $ctrl->episodeCurrent->episodeID;
?>

<div class="product-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Create Word', $ctrl->composeModuleUrl('create', 'word', ['episodeID' => $episodeID]), ['class' => 'btn-sm btn-success']) ?>
        <?= Html::a('Import from file', $ctrl->composeModuleUrl('import', 'word', ['episodeID' => $episodeID]), ['class' => 'btn-sm btn-primary']) ?>
    </p>

    <?php
    $pjaxGrid = new BGridPjaxWidget(
        $searchModel,
        $dataProvider,
        [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
            'wordID',
            [
                'attribute' => 'episodeID',
                'filter'    => false
            ],

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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],
        ],
        $filterUrl
    );
    $pjaxGrid->run();
    ?>

</div>
