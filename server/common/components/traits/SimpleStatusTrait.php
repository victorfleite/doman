<?php

/**
 * SimpleStatusTrait
 *
 * @author Victor Leite <victor.leite@gmail.com>
 * @since 1.0
 */

namespace common\components\traits;

trait SimpleStatusTrait {

    public static function getStatusLabel($p) {
        switch ($p) {
            case self::STATUS_ACTIVE:
                return self::STATUS_ACTIVE_LABEL;
            case self::STATUS_INACTIVE:
                return self::STATUS_INACTIVE_LABEL;
            default:
                break;
        }
    }

    public static function getStatusCombo() {
        return [
            self::STATUS_ACTIVE => self::STATUS_ACTIVE_LABEL,
            self::STATUS_INACTIVE => self::STATUS_INACTIVE_LABEL,
        ];
    }

}
