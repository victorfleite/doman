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
 *
 * @property \app\modules\doman\models\PlanoAtividade[] $planoAtividades
 * @property \app\modules\doman\models\Atividade[] $atividades
 * @property \app\modules\doman\models\PlanoEducadorLicenca[] $planoEducadorLicencas
 */
class Plano extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'planoAtividades',
            'atividades',
            'planoEducadorLicencas'
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
            [['status'], 'integer'],
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
            'id' => 'ID',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'status' => 'Status',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanoAtividades()
    {
        return $this->hasMany(\app\modules\doman\models\PlanoAtividade::className(), ['plano_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividades()
    {
        return $this->hasMany(\app\modules\doman\models\Atividade::className(), ['id' => 'atividade_id'])->viaTable('plano_atividade', ['plano_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanoEducadorLicencas()
    {
        return $this->hasMany(\app\modules\doman\models\PlanoEducadorLicenca::className(), ['plano_id' => 'id']);
    }
    }
