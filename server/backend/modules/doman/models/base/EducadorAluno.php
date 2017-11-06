<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "educador_aluno".
 *
 * @property integer $educador_id
 * @property integer $aluno_id
 *
 * @property \app\modules\doman\models\Aluno $aluno
 * @property \app\modules\doman\models\Educador $educador
 */
class EducadorAluno extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'aluno',
            'educador'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['educador_id', 'aluno_id'], 'required'],
            [['educador_id', 'aluno_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'educador_aluno';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'educador_id' => 'Educador ID',
            'aluno_id' => 'Aluno ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(\app\modules\doman\models\Aluno::className(), ['id' => 'aluno_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducador()
    {
        return $this->hasOne(\app\modules\doman\models\Educador::className(), ['id' => 'educador_id']);
    }
    }
