<?php
namespace frontend\modules\translate\models;

use common\ext\Helpers\GlobalHelper;
use common\models\Translate\TrEpisode;
use common\models\Translate\TrWord;
use yii\data\ActiveDataProvider;

class FWordSearch extends TrWord
{
    public $episodeIds;

    public function rules()
    {
        $rules = parent::rules();
        unset($rules["required"]);
        $rules[] = [['episodeIds'], 'string'];

        return $rules;
    }

    public function search($movieID, $params)
    {
        $className = GlobalHelper::getClassNameWithoutNamespace(static::className());

        $sessionfilterParamsHash = ySession()->get('wordsFilterHash');

        if (isset($params[$className])) {
            $filterParamsHash = md5(json_encode($params[$className]));
        } else {
            $filterParamsHash = "";
        }

        if ($sessionfilterParamsHash != $filterParamsHash) {
            ySession()->set('wordsFilterHash', $filterParamsHash);
        }

        $query = static::find()->innerJoinWith('episode')
            ->orderBy("RAND('{$filterParamsHash}')")
            ->andWhere(TrEpisode::tableName().".movieID = :movieID", [':movieID' => $movieID]);

        $this->load($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort' => ['defaultOrder' => ['episodeID' => SORT_DESC]],
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

        $episodeIds = !empty($this->episodeIds) ? explode(',', $this->episodeIds) : [];

        if (!empty($episodeIds)) {
            $query->andFilterWhere(['in', static::composeTablePlusFieldName('episodeID'), $episodeIds]);
        }

        return $dataProvider;
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels["episodePlusSeasonString"] = "S/E";
        return $labels;
    }


}
