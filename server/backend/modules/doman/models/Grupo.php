<?php

namespace app\modules\doman\models;

use Yii;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use \app\modules\doman\models\base\Grupo as BaseGrupo;

/**
 * This is the model class for table "grupo".
 */
class Grupo extends BaseGrupo implements \common\components\traits\PublicacaoStatusInterface {

    use \common\components\traits\PublicacaoStatusTrait;
 

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['titulo', 'user_id'], 'required'],
            [['descricao'], 'string'],
            [['status', 'user_id', 'user_publicacao_id'], 'integer'],
            [['data_criacao', 'data_publicacao'], 'safe'],
            [['deletado'], 'boolean'],
            [['titulo'], 'string', 'max' => 255]
        ];
    }

    public function behaviors() {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'deletado' => true
                ],
                'replaceRegularDelete' => true // mutate native `delete()` method
            ],
        ];
    }

}
