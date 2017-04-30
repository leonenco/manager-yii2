<?php

namespace backend\modules\proposals\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\proposals\models\Proposals;
use DateTime;

/**
 * SearchProposals represents the model behind the search form about `backend\modules\proposals\models\Proposals`.
 */
class SearchProposals extends Proposals
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'proposal_type_id', 'status_id', 'customer_id', 'manager_id', 'edited_by'], 'integer'],
            [['title', 'description', 'created_at', 'updated_at', 'address'], 'safe'],
            [['est_price'], 'number'],
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
        $query = Proposals::find();

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
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'proposal_type_id' => $this->proposal_type_id,
            'status_id' => $this->status_id,
            'customer_id' => $this->customer_id,
            'manager_id' => $this->manager_id,
            'est_price' => $this->est_price,
            'edited_by' => $this->edited_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
