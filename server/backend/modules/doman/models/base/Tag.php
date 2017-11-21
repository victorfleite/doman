<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "tag".
 *
 * @property integer $id
 * @property integer $frequency
 * @property string $name
 *
 * @property \app\modules\doman\models\GrupoTag[] $grupoTags
 * @property \app\modules\doman\models\Grupo[] $grupos
 */
class Tag extends \yii\db\ActiveRecord
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
            'grupoTags',
            'grupos'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'frequency' => Yii::t('translation', 'Frequency'),
            'name' => Yii::t('translation', 'Name'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoTags()
    {
        return $this->hasMany(\app\modules\doman\models\GrupoTag::className(), ['tag_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(\app\modules\doman\models\Grupo::className(), ['id' => 'grupo_id'])->viaTable('grupo_tag', ['tag_id' => 'id']);
    }
    }
