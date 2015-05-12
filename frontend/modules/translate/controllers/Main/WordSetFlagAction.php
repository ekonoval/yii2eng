<?php
namespace frontend\modules\translate\controllers\Main;

use common\models\Translate\TrWord;
use frontend\modules\translate\ext\Grid\AjaxCheckboxColumn;
use yii\base\Action;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class WordSetFlagAction extends Action
{
    public function run($action, $wordID, $val)
    {
        if (yUser()->isGuest || yUser()->identity->username != 'sunsey') {
            throw new ForbiddenHttpException("Your user is not able to set hard flags");
        }

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

        return $res;
    }
}
