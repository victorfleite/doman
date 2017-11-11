<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Plano as BasePlano;

/**
 * This is the model class for table "plano".
 */
class Plano extends BasePlano implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_replace_recursive(parent::rules(), [
            [['nome'], 'required'],
            [['descricao'], 'string'],
            [['status', 'user_id', 'ordem'], 'integer'],
            [['data_criacao'], 'safe'],
            [['nome'], 'string', 'max' => 255]
        ]);
    }

}
