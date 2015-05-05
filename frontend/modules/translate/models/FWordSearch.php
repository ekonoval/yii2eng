<?php
namespace frontend\modules\translate\models;

use common\models\Translate\TrEpisode;
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


    public function search($movieID, $params)
    {
//        $query = static::find()->with('episode');
        $query = static::find()->innerJoinWith('episode')
            ->andWhere(TrEpisode::tableName().".movieID = :movieID", [':movieID' => $movieID]);

        $this->load($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                //'pageSize' => 1
            ]
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'isHard' => $this->isHard,
            'superHard' => $this->superHard
        ]);

        $query->andFilterWhere(['like', 'wordEN', $this->wordEN]);
        $query->andFilterWhere(['like', 'wordRU', $this->wordRU]);

        return $dataProvider;
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels["episodePlusSeasonString"] = "S/E";
        return $labels;
    }


}
