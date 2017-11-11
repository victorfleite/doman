<?php

/**
 * SimpleStatusInterface
 *
 * @author Victor Leite <victor.leite@gmail.com>
 * @since 1.0
 */

namespace common\components\traits;

interface PublicacaoStatusInterface {

    const STATUS_EM_ELABORACAO = 1;
    const STATUS_EM_ELABORACAO_LABEL = 'Em elaboração';
    const STATUS_PUBLICADO = 2;
    const STATUS_PUBLICADO_LABEL = 'Publicado';
    const STATUS_INATIVO= 3;
    const STATUS_INATIVO_LABEL = 'Inativo';

    public static function getStatusLabel($status);

    public static function getStatusCombo();
}
