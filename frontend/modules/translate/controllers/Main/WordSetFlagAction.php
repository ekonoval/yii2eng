<?php
namespace frontend\modules\translate\controllers\Main;

use common\models\Translate\TrWord;
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
        }

        switch ($action) {
            case "setHard":
                $model->isHard = $val;
                $saveRes = $model->save();
                break;
        }

        return $res;
    }
}
