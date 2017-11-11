<?php

/**
 * PublicacaoStatusTrait
 *
 * @author Victor Leite <victor.leite@gmail.com>
 * @since 1.0
 */

namespace common\components\traits;

trait PublicacaoStatusTrait {

    public static function getStatusLabel($p) {
        switch ($p) {
            case self::STATUS_EM_ELABORACAO:
                return self::STATUS_EM_ELABORACAO_LABEL;
            case self::STATUS_PUBLICADO:
                return self::STATUS_PUBLICADO_LABEL;
            case self::STATUS_INATIVO:
                return self::STATUS_INATIVO_LABEL;
            default:
                break;
        }
    }

    public static function getStatusCombo() {
        return [
            self::STATUS_EM_ELABORACAO => self::STATUS_EM_ELABORACAO_LABEL,
            self::STATUS_PUBLICADO => self::STATUS_PUBLICADO_LABEL,
            self::STATUS_INATIVO => self::STATUS_INATIVO_LABEL,
        ];
    }

}
