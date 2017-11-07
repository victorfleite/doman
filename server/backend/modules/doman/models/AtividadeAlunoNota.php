<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\AtividadeAlunoNota as BaseAtividadeAlunoNota;

/**
 * This is the model class for table "atividade_aluno_nota".
 */
class AtividadeAlunoNota extends BaseAtividadeAlunoNota {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['atividade_aluno_id', 'educador_id', 'nota'], 'required'],
            [['atividade_aluno_id', 'educador_id', 'nota'], 'integer'],
            [['data_criacao'], 'safe']
        ];
    }

}
