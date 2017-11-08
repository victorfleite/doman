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
 * @property string $data_criacao
 *
 * @property \app\modules\doman\models\AtividadeAluno $atividadeAluno
 * @property \app\modules\doman\models\Educador $educador
 */
class AtividadeAlunoNota extends \yii\db\ActiveRecord
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
            [['atividade_aluno_id', 'educador_id', 'nota'], 'integer'],
            [['data_criacao'], 'safe']
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
            'id' => Yii::t('translation', 'ID'),
            'atividade_aluno_id' => Yii::t('translation', 'Atividade Aluno ID'),
            'educador_id' => Yii::t('translation', 'Educador ID'),
            'nota' => Yii::t('translation', 'Nota'),
            'data_criacao' => Yii::t('translation', 'Data Criacao'),
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
