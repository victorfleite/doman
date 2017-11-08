<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "cartao_transacao_log".
 *
 * @property integer $id
 * @property integer $cartao_aluno_id
 * @property integer $transacao_status
 * @property string $data_transacao
 *
 * @property \app\modules\doman\models\CartaoAluno $cartaoAluno
 */
class CartaoTransacaoLog extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public function __construct(){
        parent::__construct();
        $this->_rt_softdelete = [
            'deletado' => true,
        ];
        $this->_rt_softrestore = [
            'deletado' => 0,
        ];
    }

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'cartaoAluno'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cartao_aluno_id'], 'required'],
            [['cartao_aluno_id', 'transacao_status'], 'integer'],
            [['data_transacao'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cartao_transacao_log';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'cartao_aluno_id' => Yii::t('translation', 'Cartao Aluno ID'),
            'transacao_status' => Yii::t('translation', 'Transacao Status'),
            'data_transacao' => Yii::t('translation', 'Data Transacao'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartaoAluno()
    {
        return $this->hasOne(\app\modules\doman\models\CartaoAluno::className(), ['id' => 'cartao_aluno_id']);
    }
    }
