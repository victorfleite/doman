<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Educador as BaseEducador;

/**
 * This is the model class for table "educador".
 */
class Educador extends BaseEducador implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;

    const TIPO_RESPONSAVEL = 1;
    const TIPO_PROFESSOR = 2;
    const TIPO_ORIENTADOR_PEDAGOGICO = 3;
    const TIPO_RESPONSAVEL_LABEL = 'Responsável';
    const TIPO_PROFESSOR_LABEL = 'Professor';
    const TIPO_ORIENTADOR_PEDAGOGICO_LABEL = 'Orientador Pedagógico';

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome', 'email'], 'required'],
            [['email'], 'email'],
            [['tipo', 'status', 'user_id'], 'integer'],
            [['data_criacao'], 'safe'],
            [['nome', 'email'], 'string', 'max' => 255]
        ];
    }

    public static function getTipoLabel($p) {
        switch ($p) {
            case self::TIPO_RESPONSAVEL:
                return self::TIPO_RESPONSAVEL_LABEL;
            case self::TIPO_PROFESSOR:
                return self::TIPO_PROFESSOR_LABEL;
            case self::TIPO_ORIENTADOR_PEDAGOGICO:
                return self::TIPO_ORIENTADOR_PEDAGOGICO_LABEL;
            default:
                break;
        }
    }

    public static function getTipoCombo() {
        return [
            self::TIPO_RESPONSAVEL => self::TIPO_RESPONSAVEL_LABEL,
            self::TIPO_PROFESSOR => self::TIPO_PROFESSOR_LABEL,
            self::TIPO_ORIENTADOR_PEDAGOGICO => self::TIPO_ORIENTADOR_PEDAGOGICO_LABEL,
        ];
    }

    /**
     * @return Array de Alunos
     */
    public function getTodosIdsAlunos() {
        $alunos = parent::getAlunos()->all();
        $alunosIds = [];
        if (is_array($alunos)) {
            foreach ($alunos as $j) {
                $alunosIds[] = $j->id;
            }
        }
        return $alunosIds;
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
