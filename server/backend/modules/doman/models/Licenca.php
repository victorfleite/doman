<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Licenca as BaseLicenca;

/**
 * This is the model class for table "licenca".
 */
class Licenca extends BaseLicenca implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;

    const TIPO_INFINITA = 1;
    const TIPO_POR_PERIODO = 2;
    const TIPO_INFINITA_LABEL = 'Infinita';
    const TIPO_POR_PERIODO_LABEL = 'Por período';

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['educador_id', 'tipo'], 'required'],
            [['tipo'], 'validarTipo'],
            [['educador_id', 'tipo', 'status', 'user_id'], 'integer'],
            [['data_inicio', 'data_fim', 'data_criacao'], 'safe'],
            [['deletado'], 'boolean'],
            [['identificador'], 'string']
        ];
    }

    public function validarTipo($attribute, $params, $validator) {

        if ($this->$attribute == Licenca::TIPO_POR_PERIODO) {
            if (empty($this->data_inicio)) {
                $this->addError('data_inicio', 'Data início deve ser preenchida.');
            }
            if (empty($this->data_fim)) {
                $this->addError('data_fim', 'Data fim deve ser preenchida.');
            }
        }
    }

    public static function getTipoLabel($p) {
        switch ($p) {
            case self::TIPO_INFINITA:
                return self::TIPO_INFINITA_LABEL;
            case self::TIPO_POR_PERIODO:
                return self::TIPO_POR_PERIODO_LABEL;
            default:
                break;
        }
    }

    public static function getTipoCombo() {
        return [
            self::TIPO_INFINITA => self::TIPO_INFINITA_LABEL,
            self::TIPO_POR_PERIODO => self::TIPO_POR_PERIODO_LABEL,
        ];
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
