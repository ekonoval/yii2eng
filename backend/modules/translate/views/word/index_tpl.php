<?php
use backend\ext\System\BPjax;
use backend\modules\translate\controllers\TranslateController;
use backend\modules\translate\models\Word\BWordSearch;
use common\ext\Grid\Columns\BooleanColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel BWordSearch */

/** @var TranslateController $ctrl */
$ctrl = $this->context;

$this->title = 'Episodes';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => $filterUrl];

?>

<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php BPjax::begin();  ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterUrl' => $filterUrl,
        'layout' => '{pager}{items}{pager}',
        'columns' => [
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

//            'isHard',
//            'superHard',
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
    ]); ?>

    <?php BPjax::end(); ?>

</div>
