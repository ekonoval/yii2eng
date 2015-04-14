<?php
namespace backend\modules\translate\controllers;

use backend\ext\System\BackendController;

class EpisodesController extends BackendController
{
    public function actionIndex($movieID)
    {
        pa($movieID);
        pa('eps');
    }
}
