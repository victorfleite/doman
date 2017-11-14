<?php

namespace app\modules\doman\models;

use common\models\Util;
use \app\modules\doman\models\base\Aluno as BaseAluno;

/**
 * This is the model class for table "aluno".
 */
class Aluno extends BaseAluno implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;

    const TIPO_ESCOLA = 1;
    const TIPO_INTERNET = 2;
    const TIPO_ESCOLA_LABEL = 'Escola';
    const TIPO_INTERNET_LABEL = 'Internet';
    const SEXO_MASCULINO = 'M';
    const SEXO_FEMENINO = 'F';
    const SEXO_MASCULINO_LABEL = 'Masculino';
    const SEXO_FEMENINO_LABEL = 'Femenino';
    const IMAGENS_PATH = 'fotos/';

    /**
     * @var UploadedFile
     */
    public $image;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome', 'data_nascimento', 'sexo'], 'required'],
            [['data_nascimento', 'data_criacao'], 'safe'],
            [['tipo', 'user_id', 'status'], 'integer'],
            [['deletado'], 'boolean'],
            [['sexo'], 'string', 'max' => 1],
            [['nome'], 'string', 'max' => 255],
            [['imagem', 'image'], 'safe'],
            [['image'], 'file', 'maxSize' => 1024 * 1024 * 1024 * 1],
            ['image', 'image', 'extensions' => 'jpg, png',
                'minWidth' => 128, 'maxWidth' => 128,
                'minHeight' => 128, 'maxHeight' => 128,
            ]
        ];
    }

    public static function getTipoLabel($p) {
        switch ($p) {
            case self::TIPO_ESCOLA:
                return self::TIPO_ESCOLA_LABEL;
            case self::TIPO_INTERNET:
                return self::TIPO_INTERNET_LABEL;
            default:
                break;
        }
    }

    public static function getTipoCombo() {
        return [
            self::TIPO_ESCOLA => self::TIPO_ESCOLA_LABEL,
            self::TIPO_INTERNET => self::TIPO_INTERNET_LABEL,
        ];
    }

    public static function getSexoLabel($p) {
        switch ($p) {
            case self::SEXO_MASCULINO:
                return self::SEXO_MASCULINO_LABEL;
            case self::SEXO_FEMENINO:
                return self::SEXO_FEMENINO_LABEL;
            default:
                break;
        }
    }

    public static function getSexoCombo() {
        return [
            self::SEXO_MASCULINO => self::SEXO_MASCULINO_LABEL,
            self::SEXO_FEMENINO => self::SEXO_FEMENINO_LABEL,
        ];
    }

    /**
     * @return Array de Educadores
     */
    public function getTodosIdsEducadores() {
        $educadores = parent::getEducadores()->all();
        $educadoresIds = [];
        if (is_array($educadores)) {
            foreach ($educadores as $j) {
                $educadoresIds[] = $j->id;
            }
        }
        return $educadoresIds;
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
                $this->imagem = Aluno::IMAGENS_PATH . strtolower($fileName);
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
