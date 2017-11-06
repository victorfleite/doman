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
            [['titulo'], 'required'],
            [['status'], 'integer'],
            [['data_publicacao', 'data_criacao'], 'safe'],
            [['titulo'], 'string', 'max' => 255]
        ];
    }

}
