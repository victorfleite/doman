<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "atividade_aluno_nota".
 *
 * @property integer $id
 * @property integer $atividade_aluno_id
 * @property integer $educador_id
 * @property integer $nota
 *
 * @property \app\modules\doman\models\AtividadeAluno $atividadeAluno
 * @property \app\modules\doman\models\Educador $educador
 */
class AtividadeAlunoNota extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'atividadeAluno',
            'educador'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atividade_aluno_id', 'educador_id', 'nota'], 'required'],
            [['atividade_aluno_id', 'educador_id', 'nota'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'atividade_aluno_nota';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'atividade_aluno_id' => 'Atividade Aluno ID',
            'educador_id' => 'Educador ID',
            'nota' => 'Nota',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividadeAluno()
    {
        return $this->hasOne(\app\modules\doman\models\AtividadeAluno::className(), ['id' => 'atividade_aluno_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducador()
    {
        return $this->hasOne(\app\modules\doman\models\Educador::className(), ['id' => 'educador_id']);
    }
    }
