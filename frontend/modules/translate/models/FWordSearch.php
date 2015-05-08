<?php
namespace frontend\modules\translate\models;

use common\ext\Helpers\GlobalHelper;
use common\models\Translate\TrEpisode;
use common\models\Translate\TrWord;
use yii\data\ActiveDataProvider;

class FWordSearch extends TrWord
{
    public $episodeIds;

    public $curentRandSeed;

    public function rules()
    {
        $rules = parent::rules();
        unset($rules["required"]);
        $rules[] = [['episodeIds'], 'string'];

        return $rules;
    }

    private function getNumbersFromHash($hashStr)
    {
        $intStr = preg_replace('/[^\d]/', "", $hashStr);
        /**
         * PHP_IN_MAX 2147483647  - string length is 10.
         * Prevent overflow by taking less digits
         */
        if (strlen($intStr) > 9) {
            $intStr = intval(substr($intStr, 0, 9));
        }
        return $intStr;
    }

    public function search($movieID, $params)
    {
        $className = GlobalHelper::getClassNameWithoutNamespace(static::className());

        $sessionfilterParamsHash = ySession()->get('wordsFilter.Hash');

        if (isset($params[$className])) {
            $filterParamsHash = md5(json_encode($params[$className]));
        } else {
            $filterParamsHash = "";
        }

        $randSeed = ySession()->get('wordsFilter.RandSeed', 0);

        /**
         * Filter changed. On pagination click filter and hash haven't changed which means that
         * rand seeding is the same for all pages of specific filter combination
         */
        if ($sessionfilterParamsHash !== $filterParamsHash) {
            ySession()->set('wordsFilter.Hash', $filterParamsHash);
            /**
             * The same filter combination have to display different result on non-paginational requests
             */
            $randSeed = $this->getNumbersFromHash($filterParamsHash);
            $randSeed += rand(1,9999);
            ySession()->set('wordsFilter.RandSeed', $randSeed);
        }

        $this->curentRandSeed = $randSeed;

        $randSortStr = "RAND('')";
        if (!empty($randSeed)) {
            $randSortStr = "RAND('{$randSeed}')";
        }

        // when sort is clicked - don't use random sort and allow grid to handle sorting
        if (isset($params["sort"])) {
            $randSortStr = "";
        }

        $query = static::find()->innerJoinWith('episode')
            ->orderBy($randSortStr)
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
