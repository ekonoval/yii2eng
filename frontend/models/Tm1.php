<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tm1".
 *
 * @property integer $id
 * @property string $col
 * @property string $cmnt
 */
class Tm1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tm1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['col'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'col' => 'Col',
        ];
    }
}
