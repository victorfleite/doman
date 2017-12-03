<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "atividade_tag".
 *
 * @property integer $atividade_id
 * @property integer $tag_id
 *
 * @property \app\modules\doman\models\Atividade $atividade
 * @property \app\modules\doman\models\Tag $tag
 */
class AtividadeTag extends \yii\db\ActiveRecord
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
            'atividade',
            'tag'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atividade_id', 'tag_id'], 'required'],
            [['atividade_id', 'tag_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'atividade_tag';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'atividade_id' => Yii::t('translation', 'Atividade ID'),
            'tag_id' => Yii::t('translation', 'Tag ID'),
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
    public function getTag()
    {
        return $this->hasOne(\app\modules\doman\models\Tag::className(), ['id' => 'tag_id']);
    }
    }
