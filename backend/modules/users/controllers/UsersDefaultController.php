<?php

namespace backend\modules\users\controllers;

use backend\modules\users\models\PartnerSearch;
use common\models\UserAuth;
use Yii;
use yii\web\Controller;

class UsersDefaultController extends Controller
{
    public function actionIndex()
    {
        $this->join();

        //$this->with();

//        $auth = $auth[0];
//        $partners = $auth->partners;

        //pa($auth);

        return $this->render('index');
    }


    private function with()
    {
        $res = UserAuth::find()
            ->with('partners')
            ->all()
        ;
    }

    private function join()
    {
        $res = UserAuth::find()
            //->select('partner.*')
            //->select(UserAuth::tableName().'.id, login')
            ->joinWith('partners', true, 'INNER JOIN')
            ->where('partner.id > 0')
            //->asArray()
            //->all()
        ;

        $res = UserAuth::find()
            ->select('*')
            //->select(UserAuth::tableName().'.id, login')
            //->joinWith('partners', true, 'INNER JOIN')
            ->innerJoinWith(['partners' => function ($query) {
                $query->from(['p' => 'partner']);
                //$query->onCondition(['p.']);
            }], true)
//            ->joinWith(['partners' => function($query){
//                $query->from(['p' => 'partner']);
//            }], true, 'INNER JOIN')
            ->where('p.id > 0')
            ->andWhere('type = :type', [':type' => 3])
            ->all()
        ;


        pa($res);

        pa($res["0"]->partners);
        pa($res[1]->partners);
    }

    public function actionGridIndex()
    {
        $searchModel = new PartnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index_grid_tpl', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
