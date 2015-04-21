<?php
namespace backend\modules\translate\models\Word;

use common\models\Translate\TrWord;
use yii\data\ActiveDataProvider;

class BWordSearch extends TrWord
{
    public function rules()
    {
        $rules = parent::rules();
        unset($rules["required"]);
        return $rules;
    }

    public function setEpisodeID($episodeID)
    {
        $this->episodeID = intval($episodeID);
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
        $query->andWhere(['episodeID' => $this->episodeID]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort' => ['defaultOrder' => ['seasonNum' => SORT_DESC, 'episodeNum' => SORT_ASC]],
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'isHard' => $this->isHard,
            'superHard' => $this->superHard,
        ]);

        $query->andFilterWhere(['like', 'wordEN', $this->wordEN])
            ->andFilterWhere(['like', 'wordRU', $this->wordRU]);

        return $dataProvider;
    }
}
