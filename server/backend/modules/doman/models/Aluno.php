<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Aluno as BaseAluno;

/**
 * This is the model class for table "aluno".
 */
class Aluno extends BaseAluno implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;

    const TIPO_ESCOLA = 1;
    const TIPO_INTERNET = 2;
    const TIPO_ESCOLA_LABEL = 'Escola';
    const TIPO_INTERNET_LABEL = 'Internet';

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome', 'data_nascimento'], 'required'],
            [['data_nascimento', 'data_criacao'], 'safe'],
            [['tipo', 'user_id', 'status'], 'integer'],
            [['deletado'], 'boolean'],
            [['nome'], 'string', 'max' => 255]
        ];
    }

    public static function getTipoLabel($p) {
        switch ($p) {
            case self::TIPO_ESCOLA:
                return self::TIPO_ESCOLA_LABEL;
            case self::TIPO_INTERNET:
                return self::TIPO_INTERNET_LABEL;
            default:
                break;
        }
    }

    public static function getTipoCombo() {
        return [
            self::TIPO_ESCOLA => self::TIPO_ESCOLA_LABEL,
            self::TIPO_INTERNET => self::TIPO_INTERNET_LABEL,
        ];
    }

    /**
     * @return Array de Educadores
     */
    public function getTodosIdsEducadores() {
        $educadores = parent::getEducadores()->all();
        $educadoresIds = [];
        if (is_array($educadores)) {
            foreach ($educadores as $j) {
                $educadoresIds[] = $j->id;
            }
        }
        return $educadoresIds;
    }

    public function behaviors() {
        return [
            'softDeleteBehavior' => [
                'class' => \yii2tech\ar\softdelete\SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'deletado' => true
                ],
                'replaceRegularDelete' => true
            ],
        ];
    }

}
