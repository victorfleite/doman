<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\CartaoTransacaoLog as BaseCartaoTransacaoLog;

/**
 * This is the model class for table "cartao_transacao_log".
 */
class CartaoTransacaoLog extends BaseCartaoTransacaoLog {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['cartao_aluno_id'], 'required'],
            [['cartao_aluno_id', 'transacao_status'], 'integer'],
            [['data_transacao'], 'safe']
        ];
    }

}
