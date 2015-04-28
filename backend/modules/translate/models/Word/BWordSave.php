<?php
namespace backend\modules\translate\models\Word;

use common\models\Translate\TrWord;

class BWordSave extends TrWord
{

    public function init()
    {
        parent::init();
        $this->setCreateScenario();
    }

}
