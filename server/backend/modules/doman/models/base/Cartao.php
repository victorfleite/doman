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
 *
 * @property \app\modules\doman\models\Atividade $atividade
 * @property \app\modules\doman\models\CartaoAluno[] $cartaoAlunos
 */
class Cartao extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'atividade',
            'cartaoAlunos'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'atividade_id', 'imagem_caminho'], 'required'],
            [['status', 'ordem', 'atividade_id'], 'integer'],
            [['data_criacao'], 'safe'],
            [['nome', 'imagem_caminho'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cartao';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'status' => 'Status',
            'data_criacao' => 'Data Criacao',
            'ordem' => 'Ordem',
            'atividade_id' => 'Atividade ID',
            'imagem_caminho' => 'Imagem Caminho',
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
    public function getCartaoAlunos()
    {
        return $this->hasMany(\app\modules\doman\models\CartaoAluno::className(), ['cartao_id' => 'id']);
    }
    }
