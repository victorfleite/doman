<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Grupo as BaseGrupo;

/**
 * This is the model class for table "grupo".
 */
class Grupo extends BaseGrupo {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['titulo', 'status', 'user_id'], 'required'],
            [['descricao'], 'string'],
            [['status', 'user_id', 'user_publicacao_id'], 'integer'],
            [['data_publicacao'], 'safe'],
            [['titulo'], 'string', 'max' => 255]
        ];
    }

}
