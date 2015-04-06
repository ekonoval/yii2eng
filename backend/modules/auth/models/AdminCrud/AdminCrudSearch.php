<?php
namespace backend\modules\auth\models\AdminCrud;

use backend\models\BackUser;
use common\ext\Helpers\DateHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class AdminCrudSearch extends BackUser
{
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'role', 'status'], 'integer'],
            [['username', 'created_at'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BackUser::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                //'pageSize' => 2
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'role' => $this->role,
            'status' => $this->status,
        ]);

        $createdAtMysql = DateHelper::convertJqDatePickerDate2MysqlDate($this->created_at, false);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'created_at', $createdAtMysql]);

        return $dataProvider;
    }
}
