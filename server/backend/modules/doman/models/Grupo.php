<?php

namespace app\modules\doman\models;

use common\models\Util;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use \app\modules\doman\models\base\Grupo as BaseGrupo;

/**
 * This is the model class for table "grupo".
 */
class Grupo extends BaseGrupo implements \common\components\traits\PublicacaoStatusInterface {

    use \common\components\traits\PublicacaoStatusTrait;

    const IMAGENS_PATH = 'imagens/';

    /**
     * @var UploadedFile
     */
    public $image;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['titulo', 'user_id'], 'required'],
            [['descricao'], 'string'],
            [['status', 'user_id', 'user_publicacao_id', 'grupo_pai', 'ordem'], 'integer'],
            [['data_criacao', 'data_publicacao'], 'safe'],
            [['deletado'], 'boolean'],
            [['titulo'], 'string', 'max' => 255],
            [['imagem', 'image'], 'safe'],
            [['image'], 'file', 'maxSize' => 1024 * 1024 * 1024 * 1],
            ['image', 'image', 'extensions' => 'jpg, png',
                'minWidth' => 600, 'maxWidth' => 600,
                'minHeight' => 338, 'maxHeight' => 338,
        ]];
    }

    public function behaviors() {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'deletado' => true
                ],
                'replaceRegularDelete' => true // mutate native `delete()` method
            ],
        ];
    }

    /**
     * save imagem
     * @return boolean
     */
    public function upload() {

        if ($this->isNewRecord || !is_null($this->image)) {
            if ($this->validate()) {
                $ext = end((explode(".", $this->image->name)));
                // generate a unique file name to prevent duplicate filenames
                $fileName = Util::generateHashSha256(6) . "_" . Util::sanitizeString($this->image->baseName) . ".{$ext}";
                $this->imagem = Grupo::IMAGENS_PATH . strtolower($fileName);
                if (!is_null($this->image)) {
                  $this->image->saveAs($this->imagem, false);
                }
                return $this->save();
            } else {
                return false;
            }
        }
        return $this->save();
    }

}
