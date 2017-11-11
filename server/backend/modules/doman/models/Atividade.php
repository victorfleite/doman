<?php

namespace app\modules\doman\models;

use Yii;
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

}
