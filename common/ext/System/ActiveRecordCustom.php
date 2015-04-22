<?php
namespace common\ext\System;

use yii\db\ActiveRecord;

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
}
