<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Migration as BaseMigration;

/**
 * This is the model class for table "migration".
 */
class Migration extends BaseMigration {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['version'], 'required'],
            [['apply_time'], 'integer'],
            [['version'], 'string', 'max' => 180]
        ];
    }

}
