<?php
namespace backend\modules\auth\models\AdminCrud;

use backend\models\BackUser;

class AdminCrudSave extends BackUser
{
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'status'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32]
        ];
    }

    public function beforeValidate()
    {
        $parentValidate = parent::beforeValidate();

        $this->status = self::STATUS_ACTIVE;
        $this->generateAndSetAuthKey();

        $this->setPasswordHash('1');

        return $parentValidate;
    }


}
