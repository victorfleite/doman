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
 *
 * @property \app\modules\doman\models\AtividadeAluno[] $atividadeAlunos
 * @property \app\modules\doman\models\EducadorAluno[] $educadorAlunos
 * @property \app\modules\doman\models\Educador[] $educadors
 */
class Aluno extends \yii\db\ActiveRecord
{
    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'atividadeAlunos',
            'educadorAlunos',
            'educadors'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'data_nascimento'], 'required'],
            [['data_nascimento'], 'safe'],
            [['tipo'], 'integer'],
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
            'id' => 'ID',
            'nome' => 'Nome',
            'data_nascimento' => 'Data Nascimento',
            'tipo' => 'Tipo',
        ];
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
    public function getEducadores()
    {
        return $this->hasMany(\app\modules\doman\models\Educador::className(), ['id' => 'educador_id'])->viaTable('educador_aluno', ['aluno_id' => 'id']);
    }
    }
