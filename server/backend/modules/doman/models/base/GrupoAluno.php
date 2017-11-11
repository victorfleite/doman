<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "grupo_aluno".
 *
 * @property integer $grupo_id
 * @property integer $aluno_id
 * @property integer $grupo_pai
 * @property integer $status
 * @property string $data_abertura
 * @property string $data_finalizacao
 * @property string $data_criacao
 *
 * @property \app\modules\doman\models\AtividadeAluno[] $atividadeAlunos
 * @property \app\modules\doman\models\Aluno $aluno
 * @property \app\modules\doman\models\Grupo $grupo
 * @property \app\modules\doman\models\Grupo $grupoPai
 */
class GrupoAluno extends \yii\db\ActiveRecord {

    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public function __construct() {
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
    public function relationNames() {
        return [
            'atividadeAlunos',
            'aluno',
            'grupo',
            'grupoPai'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['grupo_id', 'aluno_id'], 'required'],
            [['grupo_id', 'aluno_id', 'status'], 'integer'],
            [['data_abertura', 'data_finalizacao', 'data_criacao'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'grupo_aluno';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'grupo_id' => Yii::t('translation', 'Grupo ID'),
            'aluno_id' => Yii::t('translation', 'Aluno ID'),
            'status' => Yii::t('translation', 'Status'),
            'data_abertura' => Yii::t('translation', 'Data Abertura'),
            'data_finalizacao' => Yii::t('translation', 'Data Finalizacao'),
            'data_criacao' => Yii::t('translation', 'Data Criacao'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividadeAlunos() {
        return $this->hasMany(\app\modules\doman\models\AtividadeAluno::className(), ['aluno_id' => 'aluno_id', 'grupo_id' => 'grupo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAluno() {
        return $this->hasOne(\app\modules\doman\models\Aluno::className(), ['id' => 'aluno_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo() {
        return $this->hasOne(\app\modules\doman\models\Grupo::className(), ['id' => 'grupo_id']);
    }

}
