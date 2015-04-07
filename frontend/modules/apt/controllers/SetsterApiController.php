<?php
namespace frontend\modules\apt\controllers;

use frontend\modules\apt\ext\Setster\StsApi;
use yii\base\Controller;

class SetsterApiController extends Controller
{
    public function actionTest()
    {
        $apiObj = new StsApi();
        $apiObj->auth();
    }
}
