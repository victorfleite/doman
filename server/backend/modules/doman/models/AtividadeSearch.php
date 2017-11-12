<?php

namespace app\modules\doman\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\doman\models\Atividade;

/**
 * AtividadeSearch represents the model behind the search form about `app\modules\doman\models\Atividade`.
 */
class AtividadeSearch extends Atividade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'user_id', 'user_publicacao_id', 'tipo', 'som_id'], 'integer'],
            [['titulo', 'data_publicacao', 'data_criacao', 'video_url', 'descricao'], 'safe'],
            [['deletado', 'autoplay'], 'boolean'],
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
        $query = Atividade::find()->where(['deletado'=>false]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
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
            'data_publicacao' => $this->data_publicacao,
            'data_criacao' => $this->data_criacao,
            'user_id' => $this->user_id,
            'user_publicacao_id' => $this->user_publicacao_id,
            'deletado' => $this->deletado,
            'tipo' => $this->tipo,
            'autoplay' => $this->autoplay,
            'som_id' => $this->som_id,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'video_url', $this->video_url])
            ->andFilterWhere(['like', 'descricao', $this->descricao]);

        return $dataProvider;
    }
}
