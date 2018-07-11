<?php

namespace app\modules\str\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\str\models\Material;

/**
 * MaterialSearch represents the model behind the search form of `app\modules\str\models\Material`.
 */
class MaterialSearch extends Material
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'description', 'price2', 'image_id'], 'safe'],
            [['price'], 'number'],
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
        $query = Material::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
//                'attributes' => [
//                    'id' => [
//                        'asc' => ['id' => SORT_ASC],
//                        'desc' => ['id' => SORT_DESC],
//                        'default' => SORT_DESC,
//                        'label' => 'id',
//                    ],
//                ],
                'defaultOrder' => ['id'=>SORT_DESC],
            ],
            'pagination' => [
                'pageSize' => 50,
            ],

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
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'short_desc', $this->short_desc])
            ->andFilterWhere(['like', 'price2', $this->price2])
            ->andFilterWhere(['like', 'image_id', $this->image_id]);

        return $dataProvider;
    }
}
