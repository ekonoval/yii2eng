<?php

namespace common\models\Translate;

use common\ext\System\ActiveRecordCustom;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tr_movies".
 *
 * @property integer $movieID
 * @property string $movieName
 * @property string $createDate
 */
class TrMovie extends ActiveRecordCustom
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tr_movies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createDate'], 'safe'],
            [['movieName'], 'string', 'max' => 222]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'movieID' => 'Movie ID',
            'movieName' => 'Movie Name',
            'createDate' => 'Create Date',
        ];
    }

    public function getEpisodes()
    {
        return $this->hasMany(TrEpisode::className(), ['movieID' => 'movieID']);
    }
}
