<?php

namespace app\modules\doman\models;

use common\models\Util;
use \app\modules\doman\models\base\Atividade as BaseAtividade;

/**
 * This is the model class for table "atividade".
 */
class Atividade extends BaseAtividade implements \common\components\traits\PublicacaoStatusInterface {

    use \common\components\traits\PublicacaoStatusTrait;

    const TIPO_BIT_INTELIGENCIA = 1;
    const TIPO_BIT_INTELIGENCIA_LABEL = 'Bits de Inteligência';
    const TIPO_MIDIA_YOUTUBE = 2;
    const TIPO_MIDIA_YOUTUBE_LABEL = 'Mídia Youtube';
    const TIPO_MIDIA_SOM = 3;
    const TIPO_MIDIA_SOM_LABEL = 'Mídia Som';
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
            [['titulo', 'tipo', 'user_id'], 'required'],
            [['tipo'], 'validarTipo'],
            [['status', 'user_id', 'user_publicacao_id', 'tipo', 'som_id'], 'integer'],
            [['data_publicacao', 'data_criacao', 'descricao'], 'safe'],
            [['deletado', 'autoplay'], 'boolean'],
            [['titulo', 'video_url'], 'string', 'max' => 255],
            [['video_url'], 'url'],
            [['imagem', 'image'], 'safe'],
            [['image'], 'file', 'maxSize' => 1024 * 1024 * 1024 * 1],
            ['image', 'image', 'extensions' => 'jpg, png',
                'minWidth' => 600, 'maxWidth' => 600,
                'minHeight' => 338, 'maxHeight' => 338,
            ]
        ];
    }

    public function validarTipo($attribute, $params, $validator) {

        if ($this->$attribute == Atividade::TIPO_MIDIA_YOUTUBE) {
            if (empty($this->video_url)) {
                $this->addError('video_url', 'A url do vídeo deve ser preenchida.');
            }
        }
        if ($this->$attribute == Atividade::TIPO_MIDIA_SOM) {
            if (empty($this->som_id)) {
                $this->addError('som_id', 'O som deve ser selecionado.');
            }
        }
    }

    public static function getTipoLabel($p) {
        switch ($p) {
            case self::TIPO_BIT_INTELIGENCIA:
                return self::TIPO_BIT_INTELIGENCIA_LABEL;
            case self::TIPO_MIDIA_YOUTUBE:
                return self::TIPO_MIDIA_YOUTUBE_LABEL;
            case self::TIPO_MIDIA_SOM:
                return self::TIPO_MIDIA_SOM_LABEL;
            default:
                break;
        }
    }

    public static function getTipoCombo() {
        return [
            self::TIPO_BIT_INTELIGENCIA => self::TIPO_BIT_INTELIGENCIA_LABEL,
            self::TIPO_MIDIA_YOUTUBE => self::TIPO_MIDIA_YOUTUBE_LABEL,
            self::TIPO_MIDIA_SOM => self::TIPO_MIDIA_SOM_LABEL,
        ];
    }

    public function behaviors() {
        return [
            'softDeleteBehavior' => [
                'class' => \yii2tech\ar\softdelete\SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'deletado' => true
                ],
                'replaceRegularDelete' => true
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
                $this->imagem = Atividade::IMAGENS_PATH . strtolower($fileName);
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
