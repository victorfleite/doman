<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\GrupoTag as BaseGrupoTag;

/**
 * This is the model class for table "grupo_tag".
 */
class GrupoTag extends BaseGrupoTag {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['grupo_id', 'tag_id'], 'required'],
            [['grupo_id', 'tag_id'], 'integer']
        ];
    }

}
