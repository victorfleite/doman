<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "atividade_aluno".
 *
 * @property integer $id
 * @property integer $atividade_id
 * @property integer $aluno_id
 * @property integer $status
 * @property integer $atividade_pai
 * @property string $data_criacao
 *
 * @property \app\modules\doman\models\Aluno $aluno
 * @property \app\modules\doman\models\Atividade $atividade
 * @property \app\modules\doman\models\AtividadeAluno $atividadePai
 * @property \app\modules\doman\models\AtividadeAluno[] $atividadeAlunos
 * @property \app\modules\doman\models\AtividadeAlunoNota[] $atividadeAlunoNotas
 * @property \app\modules\doman\models\CartaoAluno[] $cartaoAlunos
 */
class AtividadeAluno extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'aluno',
            'atividade',
            'atividadePai',
            'atividadeAlunos',
            'atividadeAlunoNotas',
            'cartaoAlunos'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atividade_id', 'aluno_id'], 'required'],
            [['atividade_id', 'aluno_id', 'status', 'atividade_pai'], 'integer'],
            [['data_criacao'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'atividade_aluno';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'atividade_id' => 'Atividade ID',
            'aluno_id' => 'Aluno ID',
            'status' => 'Status',
            'atividade_pai' => 'Atividade Pai',
            'data_criacao' => 'Data Criacao',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(\app\modules\doman\models\Aluno::className(), ['id' => 'aluno_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividade()
    {
        return $this->hasOne(\app\modules\doman\models\Atividade::className(), ['id' => 'atividade_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividadePai()
    {
        return $this->hasOne(\app\modules\doman\models\AtividadeAluno::className(), ['id' => 'atividade_pai']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividadeAlunos()
    {
        return $this->hasMany(\app\modules\doman\models\AtividadeAluno::className(), ['atividade_pai' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividadeAlunoNotas()
    {
        return $this->hasMany(\app\modules\doman\models\AtividadeAlunoNota::className(), ['atividade_aluno_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartaoAlunos()
    {
        return $this->hasMany(\app\modules\doman\models\CartaoAluno::className(), ['atividade_aluno_id' => 'id']);
    }
    }
