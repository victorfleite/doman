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
 *
 * @property \app\modules\doman\models\AtividadeAluno[] $atividadeAlunos
 * @property \app\modules\doman\models\Cartao[] $cartaos
 * @property \app\modules\doman\models\PlanoAtividade[] $planoAtividades
 * @property \app\modules\doman\models\Plano[] $planos
 */
class Atividade extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'atividadeAlunos',
            'cartaos',
            'planoAtividades',
            'planos'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo'], 'required'],
            [['status'], 'integer'],
            [['data_publicacao', 'data_criacao'], 'safe'],
            [['titulo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'atividade';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'status' => 'Status',
            'data_publicacao' => 'Data Publicacao',
            'data_criacao' => 'Data Criacao',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividadeAlunos()
    {
        return $this->hasMany(\app\modules\doman\models\AtividadeAluno::className(), ['atividade_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartaos()
    {
        return $this->hasMany(\app\modules\doman\models\Cartao::className(), ['atividade_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanoAtividades()
    {
        return $this->hasMany(\app\modules\doman\models\PlanoAtividade::className(), ['atividade_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanos()
    {
        return $this->hasMany(\app\modules\doman\models\Plano::className(), ['id' => 'plano_id'])->viaTable('plano_atividade', ['atividade_id' => 'id']);
    }
    }
