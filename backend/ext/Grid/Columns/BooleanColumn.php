<?php
namespace backend\ext\Grid\Columns;

use yii\grid\DataColumn;

class BooleanColumn extends DataColumn
{
    static $filterBoolOptions = [
        1 => 'Y',
        0 => 'N',
    ];

    public function init()
    {
        parent::init();
        $this->filter = self::$filterBoolOptions;
    }

    public function getDataCellValue($model, $key, $index)
    {
        $val = 'undefined';
        $attr = $this->attribute;

        if (isset(self::$filterBoolOptions[$model->$attr])) {
            $val = self::$filterBoolOptions[$model->$attr];
        }

        return $val;
    }


}
