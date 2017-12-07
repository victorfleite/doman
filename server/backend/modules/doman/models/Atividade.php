<?php

namespace app\modules\doman\models;

use Yii;
use common\models\Util;
use \app\modules\doman\models\base\Atividade as BaseAtividade;
use kartik\mpdf\Pdf;

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
    const PDF_PATH = 'docs/';

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
            [['data_publicacao', 'data_criacao', 'descricao', 'instrucao'], 'safe'],
            [['tagNames'], 'safe'],
            [['deletado', 'autoplay'], 'boolean'],
            [['titulo', 'video_url'], 'string', 'max' => 255],
            [['video_url'], 'url'],
            [['imagem', 'pdf', 'image'], 'safe'],
            [['image'], 'file', 'maxSize' => 1024 * 1024 * 1024 * 1],
            ['image', 'image', 'extensions' => 'png',
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
            'taggable' => [
                'class' => \dosamigos\taggable\Taggable::className(),
            ],
            'pdf' => [
                'class' => behaviors\AtividadePDFBehavior::className(),
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

    public function savePdf() {
        
        // Desatachar behavior para não ficar em looping infinito
        $this->detachBehavior('pdf');

        $agrupador = Util::generateHashSha256(5);
        // get your HTML raw content without any layouts or scripts
        $content = Yii::$app->controller->renderPartial(
                '@backend/modules/doman/views/atividade/_reportView', [
            'atividade' => $this,
            'agrupador' => $agrupador
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_STRING,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@backend/web/css/atividadePdf.css',
            // any css to be embedded if required
            //'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Bits de Inteligência'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => [],
                'SetFooter' => [],
            ]
        ]);

        //Yii::$app->dumper->debug($pdf->render(), true);
        $path = Yii::getAlias("@backend") . "/web/" . Atividade::PDF_PATH;
        $fileName = Util::generateHashSha256(6) . "_" . "atividade_" . $this->id . ".pdf";
        //Yii::$app->dumper->debug($path . $fileName, true);
        file_put_contents($path . $fileName, $pdf->render());

        $this->pdf = Atividade::PDF_PATH . $fileName;
        $this->save();
    }

}
