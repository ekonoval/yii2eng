<?php
namespace backend\modules\translate\models\Episode;

use common\models\Translate\TrEpisode;
use yii\data\ActiveDataProvider;

class BEpisodeSearch extends TrEpisode
{
    public $lnkWords;

    public function setMovieID($movieID)
    {
        $this->movieID = intval($movieID);
    }

//    public function rules()
//    {
//        $rules = parent::rules();
//        $rules[] = [['lnkSearch'], 'safe'];
//    }


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
        $query->andFilterWhere(['movieID' => $this->movieID]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['seasonNum' => SORT_DESC, 'episodeNum' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'seasonNum' => $this->seasonNum,
            'episodeNum' => $this->episodeNum,
        ]);

//        $createdAtMysql = DateHelper::convertJqDatePickerDate2MysqlDate($this->created_at, false);

//        $query->andFilterWhere(['like', 'movieName', $this->movieName]);
//            ->andFilterWhere(['like', 'created_at', $createdAtMysql]);

        return $dataProvider;
    }
}
