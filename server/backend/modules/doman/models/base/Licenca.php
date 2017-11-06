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
 *
 * @property \app\modules\doman\models\Educador $educador
 * @property \app\modules\doman\models\PlanoEducadorLicenca[] $planoEducadorLicencas
 */
class Licenca extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'educador',
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
            [['educador_id', 'tipo', 'status'], 'integer'],
            [['data_inicio', 'data_fim', 'data_criacao'], 'safe']
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
            'id' => 'ID',
            'educador_id' => 'Educador ID',
            'data_inicio' => 'Data Inicio',
            'data_fim' => 'Data Fim',
            'data_criacao' => 'Data Criacao',
            'tipo' => 'Tipo',
            'status' => 'Status',
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
    public function getPlanoEducadorLicencas()
    {
        return $this->hasMany(\app\modules\doman\models\PlanoEducadorLicenca::className(), ['licenca_id' => 'id']);
    }
    }
