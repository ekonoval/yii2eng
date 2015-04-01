<?php
namespace backend\modules\auth\models\AdminCrud;

use backend\ext\User\BUserRbac;
use backend\models\BackUser;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class AdminCrudSave extends BackUser
{
    const SCENARIO_EDIT = 1;
    const SCENARIO_CREATE = 2;

    public function init()
    {
        parent::init();
        $this->scenario = self::SCENARIO_CREATE;
    }

    public function setEditScenario()
    {
        $this->scenario = self::SCENARIO_EDIT;
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_EDIT] = $scenarios[self::SCENARIO_DEFAULT];
        $scenarios[self::SCENARIO_CREATE] = $scenarios[self::SCENARIO_DEFAULT];

        return $scenarios;
    }


    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'status', 'role'], 'required'],
            [['status', 'role'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            ['username', 'unique'],
            ['email', 'email']
        ];
    }

    public function beforeValidate()
    {
        //$this->scenarios();
        $parentValidate = parent::beforeValidate();

        if ($this->scenario == self::SCENARIO_CREATE) {
            $this->status = self::STATUS_ACTIVE;
            $this->generateAndSetAuthKey();

            $this->setPasswordHash('1');
        }

        return $parentValidate;
    }


}
