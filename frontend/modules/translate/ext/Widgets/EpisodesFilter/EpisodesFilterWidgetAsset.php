<?php
namespace frontend\modules\translate\ext\Widgets\EpisodesFilter;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class EpisodesFilterWidgetAsset extends AssetBundle
{
    public function init()
    {
        parent::init();

        $this->js = ['episodes-grid-filter.js'];
        $this->depends = [JqueryAsset::className()];
        $this->sourcePath = __DIR__;
    }
}
