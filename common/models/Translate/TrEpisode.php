<?php

namespace common\models\Translate;

use common\ext\System\ActiveRecordCustom;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tr_episodes".
 *
 * @property integer $episodeID
 * @property integer $seasonNum
 * @property integer $episodeNum
 * @property integer $movieID
 */
class TrEpisode extends ActiveRecordCustom
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tr_episodes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seasonNum', 'episodeNum', 'movieID'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'episodeID' => 'Episode ID',
            'seasonNum' => 'Season Num',
            'episodeNum' => 'Episode Num',
            'movieID' => 'Movie ID',
        ];
    }

    public function getWords()
    {
        return $this->hasMany(TrWord::className(), ['episodeID']);
    }

    public function getMovie()
    {
        return $this->hasOne(TrMovie::className(), ['movieID' => 'movieID']);
    }

    public function getSeasonNumList()
    {
//        $sql = "
//            SELECT DISTINCT seasonNum
//            FROM ".self::tableName()."
//            WHERE
//                1
//        ";
//
//        $res = self::findBySql($sql)
//            ->asArray()
//            ->all();

        $res = self::find()
            ->select('seasonNum')
            ->distinct()
            ->orderBy(['seasonNum' => SORT_DESC])
            ->asArray()->all()
        ;

        return $res;
    }

    public function getSeasonNumOptions()
    {
        $seasons = $this->getSeasonNumList();
        $options = ArrayHelper::map($seasons, 'seasonNum', 'seasonNum');

        return $options;
    }
}
