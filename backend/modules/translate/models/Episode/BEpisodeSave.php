<?php
namespace backend\modules\translate\models\Episode;

use common\models\Translate\TrEpisode;

class BEpisodeSave extends TrEpisode
{
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['seasonNum', 'episodeNum', 'movieID'], 'required'];
        return $rules;
    }


}
