<?php
use backend\ext\Grid\BGridPjaxWidget;
use backend\ext\Grid\Columns\BActionColumn;
use backend\ext\Grid\Columns\BCheckboxColumn;
use backend\ext\Grid\Widgets\DeleteButton\DeleteButton;
use backend\ext\System\BPjax;
use backend\modules\translate\controllers\TranslateController;
use backend\modules\translate\models\Word\BWordSearch;
use backend\ext\Grid\Columns\BooleanColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

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
        <? echo DeleteButton::widget([
            'deleteUrl' => $ctrl->composeModuleUrl('delete', 'word', ['episodeID' => $episodeID])
        ]); ?>
    </p>

    <?php
    $pjaxGrid = new BGridPjaxWidget(
        $searchModel,
        $dataProvider,
        [
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
                'class' => BActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index) {
                    switch ($action) {
                        case 'update':
                            return Url::toRoute(['update', 'id' => $key, 'episodeID' => $model->episodeID]);
                        case 'delete':
                            return Url::toRoute(['delete', 'id' => $key, 'episodeID' => $model->episodeID]);
                    }
                }
            ],
        ],
        $filterUrl
    );
    $pjaxGrid->run();
    ?>

</div>
