<?php
namespace frontend\modules\translate\controllers\Main;

use common\models\Translate\TrWord;
use frontend\modules\translate\ext\Grid\AjaxCheckboxColumn;
use yii\base\Action;
use yii\web\Response;

class WordSetFlagAction extends Action
{
    public function run($action, $wordID, $val)
    {
        yApp()->response->format = Response::FORMAT_JSON;

        $res = ['result' => 'ok'];

        /** @var TrWord $model */
        $model = null;
        if (!empty($action)) {
            $model = TrWord::findModel($wordID);

            if (in_array($action, [AjaxCheckboxColumn::ACTION_HARD, AjaxCheckboxColumn::ACTION_SUPER_HARD])) {
                $map = [
                    AjaxCheckboxColumn::ACTION_HARD => 'isHard',
                    AjaxCheckboxColumn::ACTION_SUPER_HARD => 'superHard',
                ];
                $modelKey = $map[$action];

                $model->$modelKey = $val;
                $saveRes = $model->save();
            }
        }

//        switch ($action) {
//            case AjaxCheckboxColumn::ACTION_HARD:
//                $model->isHard = $val;
//                $saveRes = $model->save();
//                break;
//
//            case AjaxCheckboxColumn::ACTION_SUPER_HARD:
//                $model->superHard = $val;
//                $saveRes = $model->save();
//                break;
//        }

        return $res;
    }
}
