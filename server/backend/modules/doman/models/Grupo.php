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

    const INICIALIZACAO_FECHADO = 0;
    const INICIALIZACAO_ABERTO = 1;
    const INICIALIZACAO_FECHADO_LABEL = 'Fechado';
    const INICIALIZACAO_ABERTO_LABEL = 'Aberto';
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
            [['titulo', 'user_id', 'inicializacao'], 'required'],
            [['descricao'], 'string'],
            [['tagNames'], 'safe'],
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
            'taggable' => [
                'class' => \dosamigos\taggable\Taggable::className(),
            ],
            'normalizador' => [
                'class' => \common\components\behaviors\NormalizadorBehavior::className(),
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

    /**
     * 
     * @param type $p
     * @return type
     */
    public static function getInicializacaoLabel($p) {
        switch ($p) {
            case self::INICIALIZACAO_FECHADO:
                return self::INICIALIZACAO_FECHADO_LABEL;
            case self::INICIALIZACAO_ABERTO:
                return self::INICIALIZACAO_ABERTO_LABEL;
            default:
                break;
        }
    }

    /**
     * 
     * @return type
     */
    public static function getInicializacaoCombo() {
        return [
            self::INICIALIZACAO_FECHADO => self::INICIALIZACAO_FECHADO_LABEL,
            self::INICIALIZACAO_ABERTO => self::INICIALIZACAO_ABERTO_LABEL,
        ];
    }

}
