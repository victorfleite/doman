<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\HistoricoAtividadeAluno as BaseHistoricoAtividadeAluno;

/**
 * This is the model class for table "public.historico_atividade_aluno".
 */
class HistoricoAtividadeAluno extends BaseHistoricoAtividadeAluno {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['educador_id', 'aluno_id', 'grupo_id', 'atividade_id'], 'required'],
            [['educador_id', 'aluno_id', 'grupo_id', 'atividade_id'], 'integer'],
            [['data_insercao'], 'safe']
        ];
    }

}
