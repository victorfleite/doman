<?php

/**
 * SimpleStatusTrait
 *
 * @author Victor Leite <victor.leite@gmail.com>
 * @since 1.0
 */

namespace common\components\traits;

trait ConvocacaoStatusTrait {

    public static function getStatusConvocacaoLabel($p) {
        switch ($p) {
            case self::STATUS_CONVOCACAO_DENTRO_ATIVIDADE:
                return self::STATUS_CONVOCACAO_DENTRO_ATIVIDADE_LABEL;
            case self::STATUS_CONVOCACAO_FORA_ATIVIDADE:
                return self::STATUS_CONVOCACAO_FORA_ATIVIDADE_LABEL;
            default:
                break;
        }
    }

    public static function getStatusConvocacaoCombo() {
        return [
            self::STATUS_CONVOCACAO_DENTRO_ATIVIDADE => self::STATUS_CONVOCACAO_DENTRO_ATIVIDADE_LABEL,
            self::STATUS_CONVOCACAO_FORA_ATIVIDADE => self::STATUS_CONVOCACAO_FORA_ATIVIDADE_LABEL,
        ];
    }

}
