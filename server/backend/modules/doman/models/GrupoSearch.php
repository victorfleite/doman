<?php

namespace app\modules\doman\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\doman\models\Grupo;

/**
 * GrupoSearch represents the model behind the search form about `app\modules\doman\models\Grupo`.
 */
class GrupoSearch extends Grupo {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'status', 'user_id', 'user_publicacao_id', 'grupo_pai', 'ordem'], 'integer'],
            [['titulo', 'descricao', 'data_criacao', 'data_publicacao'], 'safe'],
            [['deletado'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Grupo::find()->where(['deletado' => false]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['ordem' => SORT_ASC, 'id' => SORT_DESC]]
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
            'status' => $this->status,
            'user_id' => $this->user_id,
            'data_criacao' => $this->data_criacao,
            'data_publicacao' => $this->data_publicacao,
            'user_publicacao_id' => $this->user_publicacao_id,
            'deletado' => $this->deletado,
            'grupo_pai' => $this->grupo_pai,
            'ordem' => $this->ordem,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
                ->andFilterWhere(['like', 'descricao', $this->descricao]);

        return $dataProvider;
    }

}
