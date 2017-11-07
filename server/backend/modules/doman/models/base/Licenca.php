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
 *
 * @property \app\modules\doman\models\Educador $educador
 * @property \app\modules\doman\models\User $user
 * @property \app\modules\doman\models\PlanoEducadorLicenca[] $planoEducadorLicencas
 */
class Licenca extends \yii\db\ActiveRecord {

    use \mootensai\relation\RelationTrait;

    /**
     * This function helps \mootensai\relation\RelationTrait runs faster
     * @return array relation names of this model
     */
    public function relationNames() {
        return [
            'educador',
            'user',
            'planoEducadorLicencas'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['educador_id', 'tipo'], 'required'],
            [['educador_id', 'tipo', 'status', 'user_id'], 'integer'],
            [['data_inicio', 'data_fim'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'licenca';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('translation', 'ID'),
            'educador_id' => Yii::t('translation', 'Educador ID'),
            'data_inicio' => Yii::t('translation', 'Data Inicio'),
            'data_fim' => Yii::t('translation', 'Data Fim'),
            'data_criacao' => Yii::t('translation', 'Data Criacao'),
            'tipo' => Yii::t('translation', 'Tipo'),
            'status' => Yii::t('translation', 'Status'),
            'user_id' => Yii::t('translation', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducador() {
        return $this->hasOne(\app\modules\doman\models\Educador::className(), ['id' => 'educador_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(\app\modules\doman\models\User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanoEducadorLicencas() {
        return $this->hasMany(\app\modules\doman\models\PlanoEducadorLicenca::className(), ['licenca_id' => 'id']);
    }

}
