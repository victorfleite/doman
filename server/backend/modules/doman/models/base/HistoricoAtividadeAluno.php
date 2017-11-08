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
 * @property string $sessao
 *
 * @property \app\modules\doman\models\Educador $educador
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
            'educador'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atividade_aluno_id', 'educador_id', 'sessao'], 'required'],
            [['atividade_aluno_id', 'educador_id'], 'integer'],
            [['data_atividade'], 'safe'],
            [['sessao'], 'string', 'max' => 50]
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
            'id' => Yii::t('translation', 'ID'),
            'atividade_aluno_id' => Yii::t('translation', 'Atividade Aluno ID'),
            'educador_id' => Yii::t('translation', 'Educador ID'),
            'data_atividade' => Yii::t('translation', 'Data Atividade'),
            'sessao' => Yii::t('translation', 'Sessao'),
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
