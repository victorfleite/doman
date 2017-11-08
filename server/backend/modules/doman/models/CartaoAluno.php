<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\CartaoAluno as BaseCartaoAluno;

/**
 * This is the model class for table "cartao_aluno".
 */
class CartaoAluno extends BaseCartaoAluno {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['atividade_aluno_id', 'cartao_id'], 'required'],
            [['atividade_aluno_id', 'cartao_id', 'transacao_status', 'conhecido'], 'integer'],
            [['data_conhecimento'], 'safe']
        ];
    }

}
