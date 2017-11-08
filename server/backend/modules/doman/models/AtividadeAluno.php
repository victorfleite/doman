<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\AtividadeAluno as BaseAtividadeAluno;

/**
 * This is the model class for table "atividade_aluno".
 */
class AtividadeAluno extends BaseAtividadeAluno {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['atividade_id', 'aluno_id', 'grupo_id'], 'required'],
            [['atividade_id', 'aluno_id', 'status', 'atividade_pai', 'grupo_id'], 'integer'],
            [['data_criacao', 'data_abertura', 'data_finalizacao'], 'safe']
        ];
    }

}
