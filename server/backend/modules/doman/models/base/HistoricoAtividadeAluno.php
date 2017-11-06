<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "historico_atividade_aluno".
 *
 * @property integer $id
 * @property integer $atividade_aluno_id
 * @property integer $educador_id
 * @property string $data_atividade
 *
 * @property \app\modules\doman\models\Educador $educador
 */
class HistoricoAtividadeAluno extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'educador'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atividade_aluno_id', 'educador_id'], 'required'],
            [['atividade_aluno_id', 'educador_id'], 'integer'],
            [['data_atividade'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'historico_atividade_aluno';
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
            'data_atividade' => 'Data Atividade',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducador()
    {
        return $this->hasOne(\app\modules\doman\models\Educador::className(), ['id' => 'educador_id']);
    }
    }
