<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\CartaoAluno as BaseCartaoAluno;

use common\components\traits\ConvocacaoStatusInterface;
/**
 * This is the model class for table "cartao_aluno".
 */
class CartaoAluno extends BaseCartaoAluno implements ConvocacaoStatusInterface  {

     use \common\components\traits\ConvocacaoStatusTrait;
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['atividade_aluno_id', 'cartao_id'], 'required'],
            [['atividade_aluno_id', 'cartao_id', 'status_convocacao', 'conhecido'], 'integer'],
            [['data_conhecimento'], 'safe']
        ];
    }

}
