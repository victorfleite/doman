<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Tag as BaseTag;

/**
 * This is the model class for table "tag".
 */
class Tag extends BaseTag {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

}
