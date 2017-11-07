<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "cartao".
 *
 * @property integer $id
 * @property string $nome
 * @property integer $status
 * @property string $data_criacao
 * @property integer $ordem
 * @property integer $atividade_id
 * @property string $imagem_caminho
 * @property string $data_conhecimento
 * @property string $som_caminho
 * @property integer $user_id
 * @property string $data_publicacao
 * @property integer $user_publicacao_id
 *
 * @property \app\modules\doman\models\Atividade $atividade
 * @property \app\modules\doman\models\User $user
 * @property \app\modules\doman\models\User $userPublicacao
 * @property \app\modules\doman\models\CartaoAluno[] $cartaoAlunos
 */
class Cartao extends \yii\db\ActiveRecord {

    use \mootensai\relation\RelationTrait;

    /**
     * This function helps \mootensai\relation\RelationTrait runs faster
     * @return array relation names of this model
     */
    public function relationNames() {
        return [
            'atividade',
            'user',
            'userPublicacao',
            'cartaoAlunos'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome', 'atividade_id', 'imagem_caminho', 'user_id'], 'required'],
            [['status', 'ordem', 'atividade_id', 'user_id', 'user_publicacao_id'], 'integer'],
            [['data_publicacao'], 'safe'],
            [['nome', 'imagem_caminho', 'som_caminho'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cartao';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('translation', 'ID'),
            'nome' => Yii::t('translation', 'Nome'),
            'status' => Yii::t('translation', 'Status'),
            'data_criacao' => Yii::t('translation', 'Data Criacao'),
            'ordem' => Yii::t('translation', 'Ordem'),
            'atividade_id' => Yii::t('translation', 'Atividade ID'),
            'imagem_caminho' => Yii::t('translation', 'Imagem Caminho'),
            'data_conhecimento' => Yii::t('translation', 'Data Conhecimento'),
            'som_caminho' => Yii::t('translation', 'Som Caminho'),
            'user_id' => Yii::t('translation', 'User ID'),
            'data_publicacao' => Yii::t('translation', 'Data Publicacao'),
            'user_publicacao_id' => Yii::t('translation', 'User Publicacao ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividade() {
        return $this->hasOne(\app\modules\doman\models\Atividade::className(), ['id' => 'atividade_id']);
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
    public function getCartaoAlunos() {
        return $this->hasMany(\app\modules\doman\models\CartaoAluno::className(), ['cartao_id' => 'id']);
    }

}
