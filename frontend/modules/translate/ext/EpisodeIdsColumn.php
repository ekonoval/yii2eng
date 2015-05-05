<?php
namespace frontend\modules\translate\ext;

use yii\grid\DataColumn;

class EpisodeIdsColumn extends DataColumn
{
    public function init()
    {
        $this->filterInputOptions["id"] = "episodeIdsJs";
        parent::init();

    }

//    protected function renderFilterCellContent()
//    {
//
//        //return parent::renderFilterCellContent();
//    }

}
