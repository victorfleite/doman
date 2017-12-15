<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\HistoricoGrupoAluno as BaseHistoricoGrupoAluno;

/**
 * This is the model class for table "public.historico_grupo_aluno".
 */
class HistoricoGrupoAluno extends BaseHistoricoGrupoAluno {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['grupo_id', 'aluno_id', 'educador_id'], 'required'],
            [['grupo_id', 'aluno_id', 'educador_id'], 'integer'],
            [['data_acesso'], 'safe']
        ];
    }

}
