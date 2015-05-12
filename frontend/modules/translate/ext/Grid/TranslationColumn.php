<?php
namespace frontend\modules\translate\ext\Grid;

use yii\grid\DataColumn;
use yii\helpers\Html;

/**
 * Checkbox + hidden translation contents.
 * On checkbox click - display contents and set focus to next row checkbox
 */
class TranslationColumn extends DataColumn
{
    public function init()
    {
        parent::init();

        $js =<<<JS
$("input.cbShowTransl:first").focus();
$(".cbShowTransl").click(function(){
    var wordID = $(this).val();
    var idClass = "transl-"+wordID;
    $("span."+idClass).html($(".trShowContent input." + idClass).val());

    //set focus to next checkbox
    $(this).closest('tr').next('tr').find('input.cbShowTransl').focus();
});
JS;
        $this->grid->view->registerJs($js);
        $this->contentOptions = ['class' => 'td-transl'];
    }

    protected function renderDataCellContent($model, $key, $index)
    {
        $id = "transl-{$key}";
        $htmlMain = <<<HTML
<div class="trChbShow">
    %checkbox%
</div>
<div class="trShowContent">
    %content%
</div>
HTML;

        $content = "";
        $content .= Html::tag('span', '', ['class' => $id]);
        //$content .= Html::tag('span', $model->wordRU, ['class' => $id]);
        $content .= Html::hiddenInput('hdTranslInput', $model->wordRU, ['class' => $id]);

        return strtr($htmlMain, [
            '%checkbox%' => Html::checkbox('cbShowTransl', false, ['value' => $key, 'class' => 'cbShowTransl '.$id]),
            '%content%' => $content
        ]);
    }


}
