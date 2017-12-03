<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\AtividadeTag as BaseAtividadeTag;

/**
 * This is the model class for table "atividade_tag".
 */
class AtividadeTag extends BaseAtividadeTag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atividade_id', 'tag_id'], 'required'],
            [['atividade_id', 'tag_id'], 'integer']
        ];
    }
	
}
