<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Cartao as BaseCartao;

/**
 * This is the model class for table "cartao".
 */
class Cartao extends BaseCartao {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome', 'atividade_id', 'imagem_caminho', 'user_id'], 'required'],
            [['status', 'ordem', 'atividade_id', 'user_id', 'user_publicacao_id'], 'integer'],
            [['data_criacao', 'data_publicacao'], 'safe'],
            [['deletado', 'som_autoplay'], 'boolean'],
            [['nome', 'imagem_caminho'], 'string', 'max' => 255]
        ];
    }

}
