<?php
namespace common\ext\System;

use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

class ActiveRecordCustom extends ActiveRecord
{
    const SCENARIO_EDIT = 1;
    const SCENARIO_CREATE = 2;

    public function init()
    {
        parent::init();
        $this->setCreateScenario();
    }

    public function setEditScenario()
    {
        $this->scenario = self::SCENARIO_EDIT;
    }

    public function setCreateScenario()
    {
        $this->scenario = self::SCENARIO_CREATE;
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_EDIT] = $scenarios[self::SCENARIO_DEFAULT];
        $scenarios[self::SCENARIO_CREATE] = $scenarios[self::SCENARIO_DEFAULT];

        return $scenarios;
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $failMsg
     * @return static the loaded model
     * @throws NotFoundHttpException
     */
    static public function findModel($id, $failMsg = 'The requested page does not exist.')
    {
        if (($model = static::findOne($id)) !== null) {
            $model->setEditScenario();
            return $model;
        } else {
            throw new NotFoundHttpException($failMsg);
        }
    }

    public static function composeTablePlusFieldName($fieldName, $table = null)
    {
        if (is_null($table)) {
            $table = static::tableName();
        }
        return "{$table}.{$fieldName}";
    }
}
