<?php

namespace app\modules\doman\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\doman\models\Aluno;

/**
 * AlunoSearch represents the model behind the search form about `app\modules\doman\models\Aluno`.
 */
class AlunoSearch extends Aluno
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo', 'user_id', 'status'], 'integer'],
            [['nome', 'data_nascimento', 'data_criacao'], 'safe'],
            [['deletado'], 'boolean'],
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
        $query = Aluno::find()->where(['deletado'=>false]);
        

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['nome' => SORT_ASC, 'data_nascimento' => SORT_DESC]]
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
            'data_nascimento' => $this->data_nascimento,
            'tipo' => $this->tipo,
            'user_id' => $this->user_id,
            'data_criacao' => $this->data_criacao,
            'deletado' => $this->deletado,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome]);

        return $dataProvider;
    }
}
