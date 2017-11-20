<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\PlanoEducadorLicenca as BasePlanoEducadorLicenca;

/**
 * This is the model class for table "plano_educador_licenca".
 */
class PlanoEducadorLicenca extends BasePlanoEducadorLicenca {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['plano_id', 'educador_id', 'licenca_id'], 'required'],
            [['plano_id', 'educador_id', 'licenca_id'], 'integer']
        ];
    }

    public function behaviors() {
        return [
            'normalizador' => [
                'class' => \common\components\behaviors\NormalizadorBehavior::className(),
            ],
        ];
    }

}
