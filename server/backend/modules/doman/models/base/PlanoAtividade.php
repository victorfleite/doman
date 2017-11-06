<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "plano_atividade".
 *
 * @property integer $plano_id
 * @property integer $atividade_id
 *
 * @property \app\modules\doman\models\Atividade $atividade
 * @property \app\modules\doman\models\Plano $plano
 */
class PlanoAtividade extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'atividade',
            'plano'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plano_id', 'atividade_id'], 'required'],
            [['plano_id', 'atividade_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plano_atividade';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'plano_id' => 'Plano ID',
            'atividade_id' => 'Atividade ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividade()
    {
        return $this->hasOne(\app\modules\doman\models\Atividade::className(), ['id' => 'atividade_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlano()
    {
        return $this->hasOne(\app\modules\doman\models\Plano::className(), ['id' => 'plano_id']);
    }
    }
