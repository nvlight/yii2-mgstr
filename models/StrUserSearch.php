<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StrUser;

/**
 * StrUserSearch represents the model behind the search form of `app\models\StrUser`.
 */
class StrUserSearch extends StrUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'i_group', 'restore_count'], 'integer'],
            [['email', 'password', 'name', 'restore_date', 'restore_hash', 'create_date', 'update_last_date'], 'safe'],
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
        $query = StrUser::find();

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
            'i_group' => $this->i_group,
            'restore_date' => $this->restore_date,
            'restore_count' => $this->restore_count,
            'create_date' => $this->create_date,
            'update_last_date' => $this->update_last_date,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'restore_hash', $this->restore_hash]);

        return $dataProvider;
    }
}
