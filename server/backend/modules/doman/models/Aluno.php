<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Aluno as BaseAluno;

/**
 * This is the model class for table "aluno".
 */
class Aluno extends BaseAluno {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome', 'data_nascimento'], 'required'],
            [['data_nascimento'], 'safe'],
            [['tipo', 'user_id'], 'integer'],
            [['nome'], 'string', 'max' => 255]
        ];
    }

}
