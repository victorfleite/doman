<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Som as BaseSom;

/**
 * This is the model class for table "som".
 */
class Som extends BaseSom {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['titulo', 'caminho'], 'required'],
            [['titulo'], 'string'],
            [['caminho'], 'string', 'max' => 255]
        ];
    }

}
