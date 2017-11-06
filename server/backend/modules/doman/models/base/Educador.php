<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "educador".
 *
 * @property integer $id
 * @property string $nome
 * @property string $email
 * @property integer $tipo
 * @property integer $status
 *
 * @property \app\modules\doman\models\AtividadeAlunoNota[] $atividadeAlunoNotas
 * @property \app\modules\doman\models\EducadorAluno[] $educadorAlunos
 * @property \app\modules\doman\models\Aluno[] $alunos
 * @property \app\modules\doman\models\HistoricoAtividadeAluno[] $historicoAtividadeAlunos
 * @property \app\modules\doman\models\Licenca[] $licencas
 * @property \app\modules\doman\models\PlanoEducadorLicenca[] $planoEducadorLicencas
 */
class Educador extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'atividadeAlunoNotas',
            'educadorAlunos',
            'alunos',
            'historicoAtividadeAlunos',
            'licencas',
            'planoEducadorLicencas'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'email'], 'required'],
            [['tipo', 'status'], 'integer'],
            [['nome', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'educador';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'email' => 'Email',
            'tipo' => 'Tipo',
            'status' => 'Status',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividadeAlunoNotas()
    {
        return $this->hasMany(\app\modules\doman\models\AtividadeAlunoNota::className(), ['educador_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducadorAlunos()
    {
        return $this->hasMany(\app\modules\doman\models\EducadorAluno::className(), ['educador_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlunos()
    {
        return $this->hasMany(\app\modules\doman\models\Aluno::className(), ['id' => 'aluno_id'])->viaTable('educador_aluno', ['educador_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoAtividadeAlunos()
    {
        return $this->hasMany(\app\modules\doman\models\HistoricoAtividadeAluno::className(), ['educador_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLicencas()
    {
        return $this->hasMany(\app\modules\doman\models\Licenca::className(), ['educador_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanoEducadorLicencas()
    {
        return $this->hasMany(\app\modules\doman\models\PlanoEducadorLicenca::className(), ['educador_id' => 'id']);
    }
    }
