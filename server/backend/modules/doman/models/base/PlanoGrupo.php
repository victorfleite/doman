<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "plano_grupo".
 *
 * @property integer $plano_id
 * @property integer $grupo_id
 *
 * @property \app\modules\doman\models\Grupo $grupo
 * @property \app\modules\doman\models\Plano $plano
 */
class PlanoGrupo extends \yii\db\ActiveRecord {

    use \mootensai\relation\RelationTrait;

    /**
     * This function helps \mootensai\relation\RelationTrait runs faster
     * @return array relation names of this model
     */
    public function relationNames() {
        return [
            'grupo',
            'plano'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['plano_id', 'grupo_id'], 'required'],
            [['plano_id', 'grupo_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'plano_grupo';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'plano_id' => Yii::t('translation', 'Plano ID'),
            'grupo_id' => Yii::t('translation', 'Grupo ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo() {
        return $this->hasOne(\app\modules\doman\models\Grupo::className(), ['id' => 'grupo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlano() {
        return $this->hasOne(\app\modules\doman\models\Plano::className(), ['id' => 'plano_id']);
    }

}
