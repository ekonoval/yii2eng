<?php
namespace backend\ext\Grid\Columns;

use yii\grid\CheckboxColumn;
use yii\helpers\Html;

class BCheckboxColumn extends CheckboxColumn
{
    const INPUT_NAME = "gridMainCheckboxes";
    const CHECKBOXES_CSS_CLASS = "grid-control-checkboxes";

    public function init()
    {
        parent::init();
        $this->name = self::INPUT_NAME;

        $this->checkboxOptions = ['class' => self::CHECKBOXES_CSS_CLASS];

        $this->registerJs();

    }

    private function registerJs()
    {
        $checkboxClass = self::CHECKBOXES_CSS_CLASS;
        $cbSelector = "#{$this->grid->id} .{$checkboxClass}";

        $js = <<<EOD
var anyControlCheckboxSelected = false;
$("{$cbSelector}").change(function(){
    anyControlCheckboxSelected = $('#{$this->grid->id}').yiiGridView('getSelectedRows').length > 0;
    //console.log($('#{$this->grid->id}').yiiGridView('getSelectedRows').length);
});
EOD;
        $this->grid->view->registerJs($js);

    }

    /**
     * Almost completly copied from parent
     * @return string
     */
    protected function renderHeaderCellContent()
    {
        $name = rtrim($this->name, '[]') . '_all';
        $id = $this->grid->options['id'];
        $options = json_encode([
            'name' => $this->name,
            'multiple' => $this->multiple,
            'checkAll' => $name,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $this->grid->getView()->registerJs("jQuery('#$id').yiiGridView('setSelectionColumn', $options);");

        if ($this->header !== null || !$this->multiple) {
            return parent::renderHeaderCellContent();
        } else {
            return Html::checkBox($name, false, ['class' => 'select-on-check-all '.self::CHECKBOXES_CSS_CLASS]);
        }
    }

}
