<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\PlanoAtividade as BasePlanoAtividade;

/**
 * This is the model class for table "plano_atividade".
 */
class PlanoAtividade extends BasePlanoAtividade {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['plano_id', 'atividade_id'], 'required'],
            [['plano_id', 'atividade_id'], 'integer']
        ];
    }

}
