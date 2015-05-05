<?php
namespace frontend\modules\translate\models;

use common\models\Translate\TrWord;
use yii\data\ActiveDataProvider;

class FWordSearch extends TrWord
{
    public function rules()
    {
        $rules = parent::rules();
        unset($rules["required"]);
        return $rules;
    }


    public function search($params)
    {
        $query = static::find();

        $this->load($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                //'pageSize' => 1
            ]
        ]);

        if (!$this->validate()) {
            pa("exit"); exit;
            return $dataProvider;
        }

//        $query->andFilterWhere([
//            'wordEN' => $this->wordEN,
//            'wordRU' => $this->wordRU,
//        ]);
//        $query->andFilterWhere(['like', 'movieName', $this->movieName]);

        $query->andFilterWhere(['like', 'wordEN', $this->wordEN]);
        $query->andFilterWhere(['like', 'wordRU', $this->wordRU]);

        return $dataProvider;
    }
}
