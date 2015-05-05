<?php
namespace frontend\ext\Grid;

use backend\ext\System\BPjax;
use yii\base\Widget;
use yii\db\ActiveRecord;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

class FGridPjaxWidget extends Widget
{
    const GRID_JS_ID = 'mainGridId';
    protected $gridConfig;

    function __construct(ActiveRecord $searchModel, $dataProvider, $columns, $filterUrl = null, $gridConfig = [])
    {

        $customConfig = [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $columns,

            //'layout' => '{pager}{items}{pager}',
            'layout' => '{pager}<div class="spacer"></div>{items}',
            //see GridView default classes
            'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed'],
            'id' => self::GRID_JS_ID
        ];

        if (!is_null($filterUrl)) {
            $customConfig['filterUrl'] = $filterUrl;
        }

        $this->gridConfig = ArrayHelper::merge($customConfig, $gridConfig);
    }

    public function run()
    {
        parent::run();

        BPjax::begin();

        echo GridView::widget($this->gridConfig);

        BPjax::end();

    }

}
