<?php
namespace backend\modules\auth\controllers;

use backend\ext\System\BackendController;
use backend\ext\User\BUserRbac;
use backend\models\BackUser;
use backend\modules\auth\models\AdminCrud\AdminCrudSave;
use backend\modules\auth\models\AdminCrud\AdminCrudSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class AdminCrudController extends BackendController
{
//    public function behaviors()
//    {
//        $beh = ArrayHelper::merge(
//            [
//                'access' => [
//                    'rules' => [
//                        [
//                            'actions' => [],
//                            'allow' => false,
//                            'roles' => [BUserRbac::ROLE_ADMIN]
//                        ],
////                        [
////                            'allow' => true,
////                            'roles' => [BUserRbac::ROLE_ADMIN_SUPER]
////                        ],
//
//                    ]
//                ]
//            ],
//            parent::behaviors()
//        );
//
//        return $beh;
//    }

    public function actionIndex()
    {
        $searchModel = new AdminCrudSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $roles = BUserRbac::getRolesList();
        $model = new AdminCrudSave();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        } else {
            //pa($model->getErrors());
            return $this->render('create_tpl', [
                'model' => $model,
                'roles' => $roles,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $roles = BUserRbac::getRolesList();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'roles' => $roles,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminCrudSave the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminCrudSave::findOne($id)) !== null) {
            $model->setEditScenario();
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
