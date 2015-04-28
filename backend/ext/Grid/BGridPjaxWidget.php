<?php
namespace backend\ext\Grid;

use backend\ext\Grid\Columns\BCheckboxColumn;
use backend\ext\System\BPjax;
use yii\base\Widget;
use yii\db\ActiveRecord;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/**
 * Pjax begin/end and preconfigured GridView in single widget
 */
class BGridPjaxWidget extends Widget
{
    const GRID_JS_ID = 'mainGridId';
    protected $gridConfig;

    function __construct(ActiveRecord $searchModel, $dataProvider, $columns, $filterUrl = null, $gridConfig = [])
    {
        $columnsPredefined = [
            [
                'class' => BCheckboxColumn::className(),
            ]
        ];

        $columns = array_merge($columnsPredefined, $columns);

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
