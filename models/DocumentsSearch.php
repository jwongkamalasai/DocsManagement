<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Documents;
//use app\models\LContent;
//use app\models\LDep;

/**
 * DocumentsSearch represents the model behind the search form about `app\models\Documents`.
 */
class DocumentsSearch extends Documents
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'doc_id', 'years'], 'integer'],
            [['content_id', 'docno', 'doc_date', 'doc_form', 'doc_to', 'topic', 'detail', 'ref', 'deps', 'register', 'comment', 'date_receive','others','docs' ], 'safe'],
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
        $query = Documents::find();

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
            'doc_id' => $this->doc_id,
            'years' => $this->years,
            'doc_date' => $this->doc_date,
            'date_receive' => $this->date_receive,
        ]);

        $query->andFilterWhere(['like', 'content_id', $this->content_id])
            ->andFilterWhere(['like', 'docno', $this->docno])
            ->andFilterWhere(['like', 'doc_form', $this->doc_form])
            ->andFilterWhere(['like', 'doc_to', $this->doc_to])
            ->andFilterWhere(['like', 'topic', $this->topic])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'deps', $this->deps])
            ->andFilterWhere(['like', 'register', $this->register])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
