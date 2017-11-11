<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "licenca".
 *
 * @property integer $id
 * @property integer $educador_id
 * @property string $data_inicio
 * @property string $data_fim
 * @property string $data_criacao
 * @property integer $tipo
 * @property integer $status
 * @property integer $user_id
 * @property boolean $deletado
 * @property string $identificador
 *
 * @property \app\modules\doman\models\Educador $educador
 * @property \app\modules\doman\models\User $user
 * @property \app\modules\doman\models\PlanoEducadorLicenca[] $planoEducadorLicencas
 */
class Licenca extends \yii\db\ActiveRecord
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
            'educador',
            'user',
            'planoEducadorLicencas'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['educador_id', 'tipo'], 'required'],
            [['educador_id', 'tipo', 'status', 'user_id'], 'integer'],
            [['data_inicio', 'data_fim', 'data_criacao'], 'safe'],
            [['deletado'], 'boolean'],
            [['identificador'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'licenca';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'educador_id' => Yii::t('translation', 'Educador'),
            'data_inicio' => Yii::t('translation', 'Data Início'),
            'data_fim' => Yii::t('translation', 'Data Fim'),
            'data_criacao' => Yii::t('translation', 'Data Criação'),
            'tipo' => Yii::t('translation', 'Tipo'),
            'status' => Yii::t('translation', 'Status'),
            'user_id' => Yii::t('translation', 'Criador'),
            'deletado' => Yii::t('translation', 'Deletado'),
            'identificador' => Yii::t('translation', 'Identificador'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducador()
    {
        return $this->hasOne(\app\modules\doman\models\Educador::className(), ['id' => 'educador_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\modules\doman\models\User::className(), ['id' => 'user_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanoEducadorLicencas()
    {
        return $this->hasMany(\app\modules\doman\models\PlanoEducadorLicenca::className(), ['licenca_id' => 'id']);
    }
    }
