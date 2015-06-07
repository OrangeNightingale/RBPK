<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Weeks;


class WeeksSearch extends Weeks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['week_id', 'user_id'], 'integer'],
            [['week_text'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Weeks::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'week_id' => $this->week_id,
            'user_id' => $this->user_id,
            
        ]);


        return $dataProvider;
    }
}
