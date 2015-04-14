<?php
namespace backend\modules\users\models;

use common\models\UserAuth;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * @property string $login
 */
class PartnerSearch extends Model
{
    public $authId;
    public $partnerId;
    public $login;
    public $partnerName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['authId', 'partnerId', 'login', 'partnerName'], 'safe'],
        ];
    }



    public function search($params)
    {
        $query = UserAuth::find()
            ->innerJoinWith(['partners' => function ($query) {
                $query->from(['p' => 'partner']);
                //$query->onCondition(['p.']);
            }], true)
            ->where('p.id > 0')
            ->andWhere('type = :type', [':type' => 3])
        ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 1
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            //'id' => $this->id,
            //'login' => $this->login,
            //'status' => $this->status,
        ]);

        //$createdAtMysql = DateHelper::convertJqDatePickerDate2MysqlDate($this->created_at, false);

        $query->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'p.name', $this->partnerName])
        ;

        return $dataProvider;
    }

//    public function search($params)
//    {
//        $query = BackUser::find();
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//            'pagination' => [
//                //'pageSize' => 2
//            ]
//        ]);
//
//        if (!($this->load($params) && $this->validate())) {
//            return $dataProvider;
//        }
//
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'role' => $this->role,
//            'status' => $this->status,
//        ]);
//
//        $createdAtMysql = DateHelper::convertJqDatePickerDate2MysqlDate($this->created_at, false);
//
//        $query->andFilterWhere(['like', 'username', $this->username])
//            ->andFilterWhere(['like', 'created_at', $createdAtMysql]);
//
//        return $dataProvider;
//    }
}
