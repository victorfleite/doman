<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Licenca as BaseLicenca;

/**
 * This is the model class for table "licenca".
 */
class Licenca extends BaseLicenca {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['educador_id', 'tipo'], 'required'],
            [['educador_id', 'tipo', 'status', 'user_id'], 'integer'],
            [['data_inicio', 'data_fim', 'data_criacao'], 'safe'],
            [['deletado'], 'boolean'],
            [['identificador'], 'string']
        ];
    }

}
