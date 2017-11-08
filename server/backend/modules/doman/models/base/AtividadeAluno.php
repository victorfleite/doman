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
 * @property integer $grupo_id
 * @property string $data_abertura
 * @property string $data_finalizacao
 *
 * @property \app\modules\doman\models\GrupoAluno $aluno
 * @property \app\modules\doman\models\Atividade $atividade
 * @property \app\modules\doman\models\AtividadeAluno $atividadePai
 * @property \app\modules\doman\models\AtividadeAluno[] $atividadeAlunos
 * @property \app\modules\doman\models\Grupo $grupo
 * @property \app\modules\doman\models\AtividadeAlunoNota[] $atividadeAlunoNotas
 * @property \app\modules\doman\models\CartaoAluno[] $cartaoAlunos
 */
class AtividadeAluno extends \yii\db\ActiveRecord
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
            'aluno',
            'atividade',
            'atividadePai',
            'atividadeAlunos',
            'grupo',
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
            [['atividade_id', 'aluno_id', 'grupo_id'], 'required'],
            [['atividade_id', 'aluno_id', 'status', 'atividade_pai', 'grupo_id'], 'integer'],
            [['data_criacao', 'data_abertura', 'data_finalizacao'], 'safe']
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
            'id' => Yii::t('translation', 'ID'),
            'atividade_id' => Yii::t('translation', 'Atividade ID'),
            'aluno_id' => Yii::t('translation', 'Aluno ID'),
            'status' => Yii::t('translation', 'Status'),
            'atividade_pai' => Yii::t('translation', 'Atividade Pai'),
            'data_criacao' => Yii::t('translation', 'Data Criacao'),
            'grupo_id' => Yii::t('translation', 'Grupo ID'),
            'data_abertura' => Yii::t('translation', 'Data Abertura'),
            'data_finalizacao' => Yii::t('translation', 'Data Finalizacao'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(\app\modules\doman\models\GrupoAluno::className(), ['aluno_id' => 'aluno_id', 'grupo_id' => 'grupo_id']);
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
    public function getGrupo()
    {
        return $this->hasOne(\app\modules\doman\models\Grupo::className(), ['id' => 'grupo_id']);
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
