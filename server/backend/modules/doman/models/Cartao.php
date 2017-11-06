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
            [['nome', 'atividade_id', 'imagem_caminho'], 'required'],
            [['status', 'ordem', 'atividade_id'], 'integer'],
            [['data_criacao'], 'safe'],
            [['nome', 'imagem_caminho'], 'string', 'max' => 255]
        ];
    }

}
