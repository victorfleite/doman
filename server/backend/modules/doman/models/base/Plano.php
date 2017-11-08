<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "plano".
 *
 * @property integer $id
 * @property string $nome
 * @property string $descricao
 * @property integer $status
 * @property string $data_criacao
 * @property integer $user_id
 * @property boolean $deletado
 *
 * @property \app\modules\doman\models\PlanoEducadorLicenca[] $planoEducadorLicencas
 * @property \app\modules\doman\models\PlanoGrupo[] $planoGrupos
 * @property \app\modules\doman\models\Grupo[] $grupos
 */
class Plano extends \yii\db\ActiveRecord
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
            'planoEducadorLicencas',
            'planoGrupos',
            'grupos'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['descricao'], 'string'],
            [['status', 'user_id'], 'integer'],
            [['data_criacao'], 'safe'],
            [['deletado'], 'boolean'],
            [['nome'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plano';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'nome' => Yii::t('translation', 'Nome'),
            'descricao' => Yii::t('translation', 'Descricao'),
            'status' => Yii::t('translation', 'Status'),
            'data_criacao' => Yii::t('translation', 'Data Criacao'),
            'user_id' => Yii::t('translation', 'User ID'),
            'deletado' => Yii::t('translation', 'Deletado'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanoEducadorLicencas()
    {
        return $this->hasMany(\app\modules\doman\models\PlanoEducadorLicenca::className(), ['plano_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanoGrupos()
    {
        return $this->hasMany(\app\modules\doman\models\PlanoGrupo::className(), ['plano_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(\app\modules\doman\models\Grupo::className(), ['id' => 'grupo_id'])->viaTable('plano_grupo', ['plano_id' => 'id']);
    }
    }
