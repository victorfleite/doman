<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "grupo".
 *
 * @property integer $id
 * @property string $titulo
 * @property string $descricao
 * @property integer $status
 * @property integer $user_id
 * @property string $data_criacao
 * @property string $data_publicacao
 * @property integer $user_publicacao_id
 *
 * @property \app\modules\doman\models\AtividadeAluno[] $atividadeAlunos
 * @property \app\modules\doman\models\User $user
 * @property \app\modules\doman\models\User $userPublicacao
 * @property \app\modules\doman\models\GrupoAluno[] $grupoAlunos
 * @property \app\modules\doman\models\Aluno[] $alunos
 * @property \app\modules\doman\models\GrupoAtividade[] $grupoAtividades
 * @property \app\modules\doman\models\Atividade[] $atividades
 * @property \app\modules\doman\models\PlanoGrupo[] $planoGrupos
 * @property \app\modules\doman\models\Plano[] $planos
 */
class Grupo extends \yii\db\ActiveRecord {

    use \mootensai\relation\RelationTrait;

    /**
     * This function helps \mootensai\relation\RelationTrait runs faster
     * @return array relation names of this model
     */
    public function relationNames() {
        return [
            'atividadeAlunos',
            'user',
            'userPublicacao',
            'grupoAlunos',
            'alunos',
            'grupoAtividades',
            'atividades',
            'planoGrupos',
            'planos'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['titulo', 'user_id'], 'required'],
            [['descricao'], 'string'],
            [['status', 'user_id', 'user_publicacao_id'], 'integer'],
            [['data_publicacao'], 'safe'],
            [['titulo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'grupo';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('translation', 'ID'),
            'titulo' => Yii::t('translation', 'Titulo'),
            'descricao' => Yii::t('translation', 'Descricao'),
            'status' => Yii::t('translation', 'Status'),
            'user_id' => Yii::t('translation', 'User ID'),
            'data_criacao' => Yii::t('translation', 'Data Criacao'),
            'data_publicacao' => Yii::t('translation', 'Data Publicacao'),
            'user_publicacao_id' => Yii::t('translation', 'User Publicacao ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividadeAlunos() {
        return $this->hasMany(\app\modules\doman\models\AtividadeAluno::className(), ['grupo_id' => 'id']);
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
    public function getGrupoAlunos() {
        return $this->hasMany(\app\modules\doman\models\GrupoAluno::className(), ['grupo_pai' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlunos() {
        return $this->hasMany(\app\modules\doman\models\Aluno::className(), ['id' => 'aluno_id'])->viaTable('grupo_aluno', ['grupo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoAtividades() {
        return $this->hasMany(\app\modules\doman\models\GrupoAtividade::className(), ['grupo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividades() {
        return $this->hasMany(\app\modules\doman\models\Atividade::className(), ['id' => 'atividade_id'])->viaTable('grupo_atividade', ['grupo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanoGrupos() {
        return $this->hasMany(\app\modules\doman\models\PlanoGrupo::className(), ['grupo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanos() {
        return $this->hasMany(\app\modules\doman\models\Plano::className(), ['id' => 'plano_id'])->viaTable('plano_grupo', ['grupo_id' => 'id']);
    }

}