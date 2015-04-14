<?php
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


$this->title = 'Movies';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => Url::to(Yii::$app->controller->action->id)];

?>

<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <? /* ?>
    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn-sm btn-success']) ?>
    </p>
    <? */ ?>

    <?php BPjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
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
                'value' => function($data){
                    return Html::a("[episodes]",
                        $this->context->getModuleUrl('index', 'episodes', ['movieID' => $data->movieID])
                    );
                },
                'contentOptions' => ['style' => 'width: 100px; text-align:center;'],
                'format' => 'html'
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
        ],
    ]); ?>

    <?php BPjax::end(); ?>

</div>
