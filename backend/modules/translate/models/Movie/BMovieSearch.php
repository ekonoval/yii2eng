<?php
namespace backend\modules\translate\models\Movie;

use common\models\Translate\TrMovie;
use yii\data\ActiveDataProvider;

class BMovieSearch extends TrMovie
{
    public $lnkEpisodes;

    public function rules()
    {
        return [
            [['movieName'], 'safe']
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
        $query = static::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                //'pageSize' => 2
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

//        $query->andFilterWhere([
//            'id' => $this->id,
//            'role' => $this->role,
//            'status' => $this->status,
//        ]);

//        $createdAtMysql = DateHelper::convertJqDatePickerDate2MysqlDate($this->created_at, false);
//
        $query->andFilterWhere(['like', 'movieName', $this->movieName]);
//            ->andFilterWhere(['like', 'created_at', $createdAtMysql]);

        return $dataProvider;
    }
}
