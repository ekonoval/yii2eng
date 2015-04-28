<?php
namespace backend\ext\Grid\Widgets\DeleteButton;

use backend\ext\Grid\BGridPjaxWidget;
use backend\ext\Grid\Columns\BCheckboxColumn;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class DeleteButton extends Widget
{
    public $deleteUrl;
    public $gridJsId = BGridPjaxWidget::GRID_JS_ID;

    public $deleteBtnJsId = "deleteMultiBtn";

    public function init()
    {
        parent::init();

        if (empty($this->deleteUrl)) {
            $this->deleteUrl = $this->view->context->composeModuleUrl('deleteMulti');
        }

    }

    private function registerJs()
    {
        $checkboxClass = BCheckboxColumn::CHECKBOXES_CSS_CLASS;
        $js = <<<EOD
$("#{$this->gridJsId} .{$checkboxClass}").change(function(){
alert('cccc');
});
EOD;
        //$this->view->registerJs($js);
    }

    public function run()
    {
        parent::run();

        $this->registerJs();

        $html = Html::a('Delete',
            $this->deleteUrl,
            ['class' => 'btn-sm btn-warning disabled', 'id' => $this->deleteBtnJsId ]
        );

        return $html;
    }

}
