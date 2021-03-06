<?php

namespace common\models\Translate;

use common\ext\System\ActiveRecordCustom;
use Yii;

/**
 * This is the model class for table "tr_words".
 *
 * @property integer $wordID
 * @property integer $episodeID
 * @property string $wordEN
 * @property string $wordRU
 * @property integer $isHard
 * @property integer $superHard
 * @property string $episodePlusSeasonString
 */
class TrWord extends ActiveRecordCustom
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tr_words';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['episodeID', 'isHard', 'superHard'], 'integer'],
            'required' => [['wordEN', 'wordRU'], 'required'],
            [['wordEN', 'wordRU'], 'string', 'max' => 255]
        ];
    }

    public function getEpisodePlusSeasonString()
    {
        return "s{$this->episode->seasonNum}.e{$this->episode->episodeNum}";
    }

    public function getEpisode()
    {
        return $this->hasOne(TrEpisode::className(), ['episodeID' => 'episodeID'])->inverseOf('words');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wordID' => 'Word ID',
            'episodeID' => 'Episode ID',
            'wordEN' => 'Word En',
            'wordRU' => 'Word Ru',
            'isHard' => 'Is Hard',
            'superHard' => 'Super Hard',
        ];
    }
}
