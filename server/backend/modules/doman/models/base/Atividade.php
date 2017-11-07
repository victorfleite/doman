<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "atividade".
 *
 * @property integer $id
 * @property string $titulo
 * @property integer $status
 * @property string $data_publicacao
 * @property string $data_criacao
 * @property integer $user_id
 * @property integer $user_publicacao_id
 *
 * @property \app\modules\doman\models\User $user
 * @property \app\modules\doman\models\User $userPublicacao
 * @property \app\modules\doman\models\AtividadeAluno[] $atividadeAlunos
 * @property \app\modules\doman\models\Cartao[] $cartaos
 * @property \app\modules\doman\models\GrupoAtividade[] $grupoAtividades
 * @property \app\modules\doman\models\Grupo[] $grupos
 */
class Atividade extends \yii\db\ActiveRecord {

    use \mootensai\relation\RelationTrait;

    /**
     * This function helps \mootensai\relation\RelationTrait runs faster
     * @return array relation names of this model
     */
    public function relationNames() {
        return [
            'user',
            'userPublicacao',
            'atividadeAlunos',
            'cartaos',
            'grupoAtividades',
            'grupos'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['titulo', 'user_id'], 'required'],
            [['status', 'user_id', 'user_publicacao_id'], 'integer'],
            [['data_publicacao'], 'safe'],
            [['titulo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'atividade';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('translation', 'ID'),
            'titulo' => Yii::t('translation', 'Titulo'),
            'status' => Yii::t('translation', 'Status'),
            'data_publicacao' => Yii::t('translation', 'Data Publicacao'),
            'data_criacao' => Yii::t('translation', 'Data Criacao'),
            'user_id' => Yii::t('translation', 'User ID'),
            'user_publicacao_id' => Yii::t('translation', 'User Publicacao ID'),
        ];
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
    public function getUserPublicacao() {
        return $this->hasOne(\app\modules\doman\models\User::className(), ['id' => 'user_publicacao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividadeAlunos() {
        return $this->hasMany(\app\modules\doman\models\AtividadeAluno::className(), ['atividade_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartaos() {
        return $this->hasMany(\app\modules\doman\models\Cartao::className(), ['atividade_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoAtividades() {
        return $this->hasMany(\app\modules\doman\models\GrupoAtividade::className(), ['atividade_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos() {
        return $this->hasMany(\app\modules\doman\models\Grupo::className(), ['id' => 'grupo_id'])->viaTable('grupo_atividade', ['atividade_id' => 'id']);
    }

}
