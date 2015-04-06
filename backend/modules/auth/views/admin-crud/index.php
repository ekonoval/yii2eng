<?php

use backend\ext\User\BUserRbac;
use backend\modules\auth\models\AdminCrud\AdminCrudSearch;
use common\ext\Helpers\DateHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel AdminCrudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admins-Crud';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => Url::to('index')];

?>

<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn-sm btn-success']) ?>
    </p>

    <?php Pjax::begin(['id' => 'admin-crud-id', 'timeout' => false, 'enablePushState' => false, 'clientOptions' => ['method' => 'POST']]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                // you may configure additional properties here
            ],
            'id',
            'username',
            //'role',
            [
                'attribute' => 'role',
                'value' => function ($data) {
                    return BUserRbac::getRoleName($data->role);
                },
                'filter' => BUserRbac::getRolesList()
            ],
            //'status',
            [
                'attribute' => 'status',
                'value' => function ($data) use ($searchModel) {
                    return $searchModel::getStatusName($data->status);
                },
                'filter' => $searchModel::statusesList()
            ],
            //'created_at',
            [
                'attribute' => 'created_at',
                //'value' => 'created_at',
                'value' => function ($data) {
                    return DateHelper::getJqDatePickerFormatedDate($data->created_at, true);
                },
                'filter' => \yii\jui\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    //'language' => 'en',
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear' => true,
                    ],
                    //'dateFormat' => 'dd-MM-yyyy',
                    'dateFormat' => 'php:'.DateHelper::FORMAT_JQ_DATE_PICKER_NO_TIME,
                ]),
                //'format' => 'html',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
//                'buttons' => [
//                    'images' => function ($url, $model, $key) {
//                         return Html::a(
//                             '<span class="glyphicon glyphicon glyphicon-picture" aria-hidden="true"></span>',
//                             Url::to(['image/index', 'id' => $model->id])
//                         );
//                    }
//                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
