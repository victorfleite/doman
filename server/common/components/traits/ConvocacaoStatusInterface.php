<?php

/**
 * ConvocacaoStatusInterface
 *
 * @author Victor Leite <victor.leite@gmail.com>
 * @since 1.0
 */

namespace common\components\traits;

interface ConvocacaoStatusInterface {

    const STATUS_CONVOCACAO_DENTRO_ATIVIDADE = 1;
    const STATUS_CONVOCACAO_DENTRO_ATIVIDADE_LABEL = 'Sim';
    
     const STATUS_CONVOCACAO_FORA_ATIVIDADE = 2;
    const STATUS_CONVOCACAO_FORA_ATIVIDADE_LABEL = 'Não';

    public static function getStatusConvocacaoLabel($status);

    public static function getStatusConvocacaoCombo();
}
