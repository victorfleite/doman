<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "aluno".
 *
 * @property integer $id
 * @property string $nome
 * @property string $data_nascimento
 * @property integer $tipo
 * @property integer $user_id
 * @property string $data_criacao
 * @property boolean $deletado
 * @property integer $status
 *
 * @property \app\modules\doman\models\User $user
 * @property \app\modules\doman\models\AtividadeAluno[] $atividadeAlunos
 * @property \app\modules\doman\models\EducadorAluno[] $educadorAlunos
 * @property \app\modules\doman\models\Educador[] $educadors
 * @property \app\modules\doman\models\GrupoAluno[] $grupoAlunos
 * @property \app\modules\doman\models\Grupo[] $grupos
 */
class Aluno extends \yii\db\ActiveRecord
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
            'user',
            'atividadeAlunos',
            'educadorAlunos',
            'educadors',
            'grupoAlunos',
            'grupos'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'data_nascimento'], 'required'],
            [['data_nascimento', 'data_criacao'], 'safe'],
            [['tipo', 'user_id', 'status'], 'integer'],
            [['deletado'], 'boolean'],
            [['nome'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aluno';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'nome' => Yii::t('translation', 'Nome'),
            'data_nascimento' => Yii::t('translation', 'Data Nascimento'),
            'tipo' => Yii::t('translation', 'Tipo'),
            'user_id' => Yii::t('translation', 'Criador'),
            'data_criacao' => Yii::t('translation', 'Data Criacao'),
            'deletado' => Yii::t('translation', 'Deletado'),
            'status' => Yii::t('translation', 'Status'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\modules\doman\models\User::className(), ['id' => 'user_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividadeAlunos()
    {
        return $this->hasMany(\app\modules\doman\models\AtividadeAluno::className(), ['aluno_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducadorAlunos()
    {
        return $this->hasMany(\app\modules\doman\models\EducadorAluno::className(), ['aluno_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducadors()
    {
        return $this->hasMany(\app\modules\doman\models\Educador::className(), ['id' => 'educador_id'])->viaTable('educador_aluno', ['aluno_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoAlunos()
    {
        return $this->hasMany(\app\modules\doman\models\GrupoAluno::className(), ['aluno_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(\app\modules\doman\models\Grupo::className(), ['id' => 'grupo_id'])->viaTable('grupo_aluno', ['aluno_id' => 'id']);
    }
    }
