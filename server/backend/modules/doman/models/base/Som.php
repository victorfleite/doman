<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "som".
 *
 * @property integer $id
 * @property string $titulo
 * @property string $caminho
 *
 * @property \app\modules\doman\models\Atividade[] $atividades
 * @property \app\modules\doman\models\CartaoSom[] $cartaoSoms
 * @property \app\modules\doman\models\Cartao[] $cartaos
 */
class Som extends \yii\db\ActiveRecord
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
            'atividades',
            'cartaoSoms',
            'cartaos'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'caminho'], 'required'],
            [['titulo'], 'string'],
            [['caminho'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'som';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'titulo' => Yii::t('translation', 'Titulo'),
            'caminho' => Yii::t('translation', 'Caminho'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividades()
    {
        return $this->hasMany(\app\modules\doman\models\Atividade::className(), ['som_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartaoSoms()
    {
        return $this->hasMany(\app\modules\doman\models\CartaoSom::className(), ['som_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartaos()
    {
        return $this->hasMany(\app\modules\doman\models\Cartao::className(), ['id' => 'cartao_id'])->viaTable('cartao_som', ['som_id' => 'id']);
    }
    }
