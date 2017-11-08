<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\GrupoAluno as BaseGrupoAluno;

/**
 * This is the model class for table "grupo_aluno".
 */
class GrupoAluno extends BaseGrupoAluno {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['grupo_id', 'aluno_id'], 'required'],
            [['grupo_id', 'aluno_id', 'grupo_pai', 'status'], 'integer'],
            [['data_abertura', 'data_finalizacao', 'data_criacao'], 'safe']
        ];
    }

}
