<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "public.historico_grupo_aluno".
 *
 * @property integer $id
 * @property integer $grupo_id
 * @property integer $aluno_id
 * @property integer $educador_id
 * @property string $data_acesso
 */
class HistoricoGrupoAluno extends \yii\db\ActiveRecord
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
            [['grupo_id', 'aluno_id', 'educador_id'], 'required'],
            [['grupo_id', 'aluno_id', 'educador_id'], 'integer'],
            [['data_acesso'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.historico_grupo_aluno';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'grupo_id' => Yii::t('translation', 'Grupo ID'),
            'aluno_id' => Yii::t('translation', 'Aluno ID'),
            'educador_id' => Yii::t('translation', 'Educador ID'),
            'data_acesso' => Yii::t('translation', 'Data Acesso'),
        ];
    }
}
