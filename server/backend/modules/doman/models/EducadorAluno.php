<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\EducadorAluno as BaseEducadorAluno;

/**
 * This is the model class for table "educador_aluno".
 */
class EducadorAluno extends BaseEducadorAluno {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['educador_id', 'aluno_id'], 'required'],
            [['educador_id', 'aluno_id'], 'integer'],
            [['data_criacao'], 'safe']
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
