<?php

namespace common\models\Translate;

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
 */
class TrWord extends \yii\db\ActiveRecord
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
