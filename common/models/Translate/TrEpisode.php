<?php

namespace common\models\Translate;

use Yii;

/**
 * This is the model class for table "tr_episodes".
 *
 * @property integer $episodeID
 * @property integer $seasonNum
 * @property integer $episodeNum
 * @property integer $movieID
 */
class TrEpisode extends \yii\db\ActiveRecord
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
        $this->hasMany(TrWord::className(), ['episodeID']);
    }
}
