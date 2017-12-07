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
 * @property boolean $deletado
 * @property integer $tipo
 * @property string $video_url
 * @property boolean $autoplay
 * @property integer $som_id
 *
 * @property \app\modules\doman\models\Som $som
 * @property \app\modules\doman\models\User $user
 * @property \app\modules\doman\models\User $userPublicacao
 * @property \app\modules\doman\models\AtividadeAluno[] $atividadeAlunos
 * @property \app\modules\doman\models\Cartao[] $cartaos
 * @property \app\modules\doman\models\GrupoAtividade[] $grupoAtividades
 * @property \app\modules\doman\models\Grupo[] $grupos
 */
class Atividade extends \yii\db\ActiveRecord {

    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public function __construct() {
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
    public function relationNames() {
        return [
            'som',
            'user',
            'userPublicacao',
            'atividadeAlunos',
            'cartoes',
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
            [['status', 'user_id', 'user_publicacao_id', 'tipo', 'som_id'], 'integer'],
            [['data_publicacao', 'data_criacao', 'descricao', 'instrucao'], 'safe'],
            [['deletado', 'autoplay'], 'boolean'],
            [['titulo', 'video_url'], 'string', 'max' => 255]
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
            'user_id' => Yii::t('translation', 'Criador'),
            'user_publicacao_id' => Yii::t('translation', 'User Publicacao ID'),
            'deletado' => Yii::t('translation', 'Deletado'),
            'tipo' => Yii::t('translation', 'Tipo'),
            'video_url' => Yii::t('translation', 'Vídeo Url'),
            'autoplay' => Yii::t('translation', 'Autoplay'),
            'som_id' => Yii::t('translation', 'Som'),
            'atividade_pai' => Yii::t('translation', 'Atividade Pai'),
            'descricao'=>Yii::t('translation', 'Descrição'),
            'instrucao'=>Yii::t('translation', 'Instrução'),
            'tagNames' => Yii::t('translation', 'Tags'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSom() {
        return $this->hasOne(\app\modules\doman\models\Som::className(), ['id' => 'som_id']);
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
    public function getCartoes() {
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
    
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags() {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('atividade_tag', ['atividade_id' => 'id']);
    }


}
