<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Atividade as BaseAtividade;

/**
 * This is the model class for table "atividade".
 */
class Atividade extends BaseAtividade {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['titulo', 'user_id'], 'required'],
            [['status', 'user_id', 'user_publicacao_id'], 'integer'],
            [['data_publicacao'], 'safe'],
            [['titulo'], 'string', 'max' => 255]
        ];
    }

}
