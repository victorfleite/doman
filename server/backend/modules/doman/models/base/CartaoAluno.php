<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "cartao_aluno".
 *
 * @property integer $id
 * @property integer $atividade_aluno_id
 * @property integer $cartao_id
 * @property integer $transacao_status
 * @property integer $conhecido
 *
 * @property \app\modules\doman\models\AtividadeAluno $atividadeAluno
 * @property \app\modules\doman\models\Cartao $cartao
 * @property \app\modules\doman\models\CartaoTransacaoLog[] $cartaoTransacaoLogs
 */
class CartaoAluno extends \yii\db\ActiveRecord {

    use \mootensai\relation\RelationTrait;

    /**
     * This function helps \mootensai\relation\RelationTrait runs faster
     * @return array relation names of this model
     */
    public function relationNames() {
        return [
            'atividadeAluno',
            'cartao',
            'cartaoTransacaoLogs'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['atividade_aluno_id', 'cartao_id'], 'required'],
            [['atividade_aluno_id', 'cartao_id', 'transacao_status', 'conhecido'], 'integer'],
            [['data_conhecimento'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cartao_aluno';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('translation', 'ID'),
            'atividade_aluno_id' => Yii::t('translation', 'Atividade Aluno ID'),
            'cartao_id' => Yii::t('translation', 'Cartao ID'),
            'transacao_status' => Yii::t('translation', 'Transacao Status'),
            'conhecido' => Yii::t('translation', 'Conhecido'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividadeAluno() {
        return $this->hasOne(\app\modules\doman\models\AtividadeAluno::className(), ['id' => 'atividade_aluno_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartao() {
        return $this->hasOne(\app\modules\doman\models\Cartao::className(), ['id' => 'cartao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartaoTransacaoLogs() {
        return $this->hasMany(\app\modules\doman\models\CartaoTransacaoLog::className(), ['cartao_aluno_id' => 'id']);
    }

}
