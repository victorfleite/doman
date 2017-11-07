<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Educador as BaseEducador;

/**
 * This is the model class for table "educador".
 */
class Educador extends BaseEducador {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome', 'email'], 'required'],
            [['tipo', 'status', 'user_id'], 'integer'],
            [['nome', 'email'], 'string', 'max' => 255]
        ];
    }

}
