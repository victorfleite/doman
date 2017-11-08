<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\CartaoSom as BaseCartaoSom;

/**
 * This is the model class for table "cartao_som".
 */
class CartaoSom extends BaseCartaoSom {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['cartao_id', 'som_id'], 'required'],
            [['cartao_id', 'som_id'], 'integer']
        ];
    }

}
