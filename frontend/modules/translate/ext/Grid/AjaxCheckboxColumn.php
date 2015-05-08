<?php
namespace frontend\modules\translate\ext\Grid;

use backend\ext\Grid\Columns\BooleanColumn;
use yii\helpers\Html;

class AjaxCheckboxColumn extends BooleanColumn
{
    public $modelKeyUpdate = 'isHard';

    public function init()
    {
        parent::init();

        $ajaxUrl = "/translate/word-set-flag";
        $action = "setHard";

        $js = <<<JS
$("input.ajaxCbHard").click(function(){
    $.getJSON(
        '{$ajaxUrl}',
        {
            wordID: $(this).val(),
            val: $(this).is(':checked') | 0, // bool to int
            action: '{$action}'
        },
        function (data) {
            console.log(data);
        }
    );
});
JS;
        $this->grid->view->registerJs($js);
    }

    protected function renderDataCellContent($model, $key, $index)
    {
        //return parent::renderDataCellContent($model, $key, $index);
        $isChecked = (bool)$model->{$this->modelKeyUpdate};
        $html = Html::checkbox('ajaxCb', $isChecked, ['value' => $key, 'class' => 'ajaxCb ajaxCbHard']);

        return $html;
    }

}
