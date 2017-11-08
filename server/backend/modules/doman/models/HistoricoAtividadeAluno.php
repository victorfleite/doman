<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\HistoricoAtividadeAluno as BaseHistoricoAtividadeAluno;

/**
 * This is the model class for table "historico_atividade_aluno".
 */
class HistoricoAtividadeAluno extends BaseHistoricoAtividadeAluno {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['atividade_aluno_id', 'educador_id', 'sessao'], 'required'],
            [['atividade_aluno_id', 'educador_id'], 'integer'],
            [['data_atividade'], 'safe'],
            [['sessao'], 'string', 'max' => 50]
        ];
    }

}
