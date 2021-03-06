<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "public.historico_atividade_aluno".
 *
 * @property integer $id
 * @property integer $educador_id
 * @property integer $aluno_id
 * @property integer $grupo_id
 * @property integer $atividade_id
 * @property string $data_insercao
 */
class HistoricoAtividadeAluno extends \yii\db\ActiveRecord
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
            ''
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['educador_id', 'aluno_id', 'grupo_id', 'atividade_id'], 'required'],
            [['educador_id', 'aluno_id', 'grupo_id', 'atividade_id'], 'integer'],
            [['data_insercao'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.historico_atividade_aluno';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'educador_id' => Yii::t('translation', 'Educador ID'),
            'aluno_id' => Yii::t('translation', 'Aluno ID'),
            'grupo_id' => Yii::t('translation', 'Grupo ID'),
            'atividade_id' => Yii::t('translation', 'Atividade ID'),
            'data_insercao' => Yii::t('translation', 'Data Insercao'),
        ];
    }
}
