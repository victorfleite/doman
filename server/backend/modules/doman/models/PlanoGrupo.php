<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\PlanoGrupo as BasePlanoGrupo;

/**
 * This is the model class for table "plano_grupo".
 */
class PlanoGrupo extends BasePlanoGrupo {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['plano_id', 'grupo_id', 'ordem'], 'required'],
            [['plano_id', 'grupo_id'], 'integer']
        ];
    }

}
