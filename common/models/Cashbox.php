<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cashbox".
 *
 * @property integer $id
 * @property string $name
 * @property string $map_widget
 */
class Cashbox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cashbox';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'map_widget'], 'required'],
            [['map_widget'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'map_widget' => 'Map Widget',
        ];
    }
}
