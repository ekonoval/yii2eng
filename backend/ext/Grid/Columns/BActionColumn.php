<?php
namespace backend\ext\Grid\Columns;

use yii\grid\ActionColumn;

class BActionColumn extends ActionColumn
{
    public $allowEdit = true;
    public $allowDelete = true;

    public function init()
    {
        parent::init();

        $this->template = sprintf('%s%s',
            $this->allowEdit ? '{update}' : '',
            $this->allowDelete ? '{delete}' : ''
        );

        $this->contentOptions = ['style' => 'width: 60px; text-align:center;'];
    }

}
