<?php
namespace frontend\modules\translate\models;

use common\models\Translate\TrMovie;
use yii\data\ActiveDataProvider;

class FMovieSearch extends TrMovie
{
    public function search($params)
    {
        $query = static::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                //'pageSize' => 1
            ]
        ]);

        return $dataProvider;
    }
}
