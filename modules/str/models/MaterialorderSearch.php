<?php

namespace app\modules\str\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\str\models\Materialorder;

/**
 * MaterialorderSearch represents the model behind the search form of `app\modules\str\models\Materialorder`.
 */
class MaterialorderSearch extends Materialorder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_project', 'id_room', 'id_material', 'count', 'price'], 'integer'],
            [['note'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Materialorder::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_project' => $this->id_project,
            'id_room' => $this->id_room,
            'id_material' => $this->id_material,
            'count' => $this->count,
            'price' => $this->price,
            'price2' => $this->price2,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
