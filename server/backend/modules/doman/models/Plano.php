<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Plano as BasePlano;

/**
 * This is the model class for table "plano".
 */
class Plano extends BasePlano {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome'], 'required'],
            [['descricao'], 'string'],
            [['status', 'user_id'], 'integer'],
            [['nome'], 'string', 'max' => 255]
        ];
    }

}
