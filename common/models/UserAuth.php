<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_auth".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property string $login
 * @property string $pwd
 * @property integer $type
 */
class UserAuth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_auth';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id', 'login', 'pwd', 'type'], 'required'],
            [['entity_id', 'type'], 'integer'],
            [['login', 'pwd'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'Entity ID',
            'login' => 'Login',
            'pwd' => 'Pwd',
            'type' => 'Type',
        ];
    }

    public function getPartners()
    {
        return $this->hasOne(Partner::className(), ['id' => 'entity_id']);
    }

}
