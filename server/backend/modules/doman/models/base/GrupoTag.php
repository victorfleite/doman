<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "grupo_tag".
 *
 * @property integer $grupo_id
 * @property integer $tag_id
 *
 * @property \app\modules\doman\models\Grupo $grupo
 * @property \app\modules\doman\models\Tag $tag
 */
class GrupoTag extends \yii\db\ActiveRecord
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
            'grupo',
            'tag'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grupo_id', 'tag_id'], 'required'],
            [['grupo_id', 'tag_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo_tag';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'grupo_id' => Yii::t('translation', 'Grupo ID'),
            'tag_id' => Yii::t('translation', 'Tag ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo()
    {
        return $this->hasOne(\app\modules\doman\models\Grupo::className(), ['id' => 'grupo_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(\app\modules\doman\models\Tag::className(), ['id' => 'tag_id']);
    }
    }
