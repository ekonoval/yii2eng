<?php
namespace backend\ext\Grid\Widgets\DeleteButton;

use backend\ext\Grid\BGridPjaxWidget;
use backend\ext\Grid\Columns\BCheckboxColumn;
use yii\bootstrap\Widget;
use yii\helpers\Html;
use yii\web\View;

class DeleteButton extends Widget
{
    public $deleteUrl;
    public $gridJsId = BGridPjaxWidget::GRID_JS_ID;

    public $deleteBtnJsId = "deleteMultiBtn";

    public function init()
    {
        parent::init();

        if (empty($this->deleteUrl)) {
            $this->deleteUrl = $this->view->context->composeModuleUrl('delete');
        }

    }

    private function registerJs()
    {
        $deleteMultiBtnOptions = [
            'deleteUrl' => $this->deleteUrl,
            'deleteBtnJsId' => $this->deleteBtnJsId,
            'gridJsId' => $this->gridJsId
        ];
        $deleteMultiBtnOptions = json_encode($deleteMultiBtnOptions);

        $jsTop = <<<EOD1
var deleteMultiBtnOptions = {$deleteMultiBtnOptions};
EOD1;
        $this->view->registerJs($jsTop, View::POS_HEAD);

    }

    public function run()
    {
        parent::run();

        DeleteButtonAsset::register($this->view);

        $this->registerJs();

        $html = Html::a('Delete',
            "",
            ['class' => 'btn-sm btn-warning', 'id' => $this->deleteBtnJsId ]
        );

        return $html;
    }

}
