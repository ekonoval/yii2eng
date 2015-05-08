<?php
namespace frontend\modules\translate\ext\Grid;

use yii\grid\DataColumn;
use yii\helpers\Html;

class TranslationColumn extends DataColumn
{
    public function init()
    {
        parent::init();

        $js =<<<JS
$(".cbShowTransl").click(function(){
    alert("clc");
});
JS;
        $this->grid->view->registerJs($js);
        $this->contentOptions = ['class' => 'td-transl'];
    }

    protected function renderDataCellContent($model, $key, $index)
    {
        //return parent::renderDataCellContent($model, $key, $index);
        //return "Hid {$model->wordRU}";
        $id = "translContainer-{$key}";
        $htmlMain = <<<HTML
<div class="trChbShow">
    %checkbox%
</div>
<div class="trShowContent">
    %content%
</div>
HTML;


        //$html .= Html::checkbox('cbShowTransl');
        //$html .= "<span>{$model->wordRU}</span>";
        $content = "";
        $content .= Html::tag('span', '', ['class' => $id]);
        //$content .= Html::tag('span', $model->wordRU, ['class' => $id]);
        $content .= Html::hiddenInput('hdTranslInput', $model->wordRU, ['class' => $id]);

        return strtr($htmlMain, [
            '%checkbox%' => Html::checkbox('cbShowTransl', false, ['value' => $key, 'class' => 'cbShowTransl']),
            '%content%' => $content
        ]);
    }


}
