<?php
namespace frontend\modules\translate\ext\Widgets\EpisodesFilter;

use frontend\ext\Grid\FGridPjaxWidget;
use yii\base\Widget;

class EpisodesFilterWidget extends Widget
{
    public $episodes;

    public function run()
    {
        //parent::run();
        EpisodesFilterWidgetAsset::register($this->view);

        $gridID = FGridPjaxWidget::GRID_JS_ID;
        $js =<<<EOD
var episodeFilterManager = new EpisodeGridFilter('#$gridID');
EOD;
        $this->view->registerJs($js);


        return $this->render('wIndex_tpl');
    }

}
