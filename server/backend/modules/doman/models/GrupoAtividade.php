<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\GrupoAtividade as BaseGrupoAtividade;

/**
 * This is the model class for table "grupo_atividade".
 */
class GrupoAtividade extends BaseGrupoAtividade {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['grupo_id', 'atividade_id'], 'required'],
            [['grupo_id', 'atividade_id', 'ordem'], 'integer']
        ];
    }

}
