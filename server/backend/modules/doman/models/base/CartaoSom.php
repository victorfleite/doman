<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "cartao_som".
 *
 * @property integer $cartao_id
 * @property integer $som_id
 *
 * @property \app\modules\doman\models\Cartao $cartao
 * @property \app\modules\doman\models\Som $som
 */
class CartaoSom extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'cartao',
            'som'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cartao_id', 'som_id'], 'required'],
            [['cartao_id', 'som_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cartao_som';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cartao_id' => Yii::t('translation', 'Cartao ID'),
            'som_id' => Yii::t('translation', 'Som ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartao()
    {
        return $this->hasOne(\app\modules\doman\models\Cartao::className(), ['id' => 'cartao_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSom()
    {
        return $this->hasOne(\app\modules\doman\models\Som::className(), ['id' => 'som_id']);
    }
    }
