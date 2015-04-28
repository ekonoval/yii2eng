<?php
namespace backend\ext\Grid\Widgets\DeleteButton;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class DeleteButtonAsset extends AssetBundle
{
    //public $js = ['delete-btn.js'];


    public function init()
    {
        parent::init();

        $this->js = ['delete-btn.js'];
        $this->depends = [JqueryAsset::className()];
        $this->sourcePath = __DIR__;
    }

}
