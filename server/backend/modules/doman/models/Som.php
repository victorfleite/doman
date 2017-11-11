<?php

namespace app\modules\doman\models;

use Yii;
use \app\modules\doman\models\base\Som as BaseSom;
use common\models\Util;

/**
 * This is the model class for table "som".
 */
class Som extends BaseSom {

    const SOM_PATH = 'sons/';

    /**
     * @var UploadedFile
     */
    public $mp3;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['titulo'], 'required'],
            [['titulo'], 'string'],
            [['caminho', 'mp3'], 'safe'],
            [['mp3'], 'file', 'maxSize' => 1024 * 1024 * 1024 * 15],
            [['mp3'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp3'],
        ];
    }

    /**
     * save som
     * @return boolean
     */
    public function upload() {

        if ($this->isNewRecord || !is_null($this->mp3)) {
            if ($this->validate()) {
                $ext = end((explode(".", $this->mp3->name)));
                // generate a unique file name to prevent duplicate filenames
                $fileName = Util::generateHashSha256(6) . "_" . Util::sanitizeString($this->mp3->baseName) . ".{$ext}";
                $this->caminho = SOM::SOM_PATH . strtolower($fileName);
                $this->mp3->saveAs($this->caminho, false);

                return $this->save();
            } else {
                return false;
            }
        }
        return true;
    }

}
