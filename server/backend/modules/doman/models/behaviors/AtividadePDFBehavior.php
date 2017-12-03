<?php

namespace app\modules\doman\models\behaviors;

use Yii;
use yii\db\ActiveRecord;
use yii\base\Behavior;
use common\models\Util;
use \app\modules\doman\models\Atividade;
use \app\modules\doman\models\Cartao;
use kartik\mpdf\Pdf;

/**
 * Este behavior é responsável por executar uma store procedure que 
 * cria grupos e atividades novas aos alunos já existentes normalizando as atividades
 */
class AtividadePDFBehavior extends Behavior {

    /**
     * 
     * @return type
     */
    public function events() {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'run',
            ActiveRecord::EVENT_AFTER_UPDATE => 'run',
            ActiveRecord::EVENT_AFTER_DELETE => 'run',
        ];
    }

    public function run($event) {

        $atividade = $this->owner->atividade;
        if ($atividade->tipo == Atividade::TIPO_BIT_INTELIGENCIA) {

            $agrupador = Util::generateHashSha256(5);
            // get your HTML raw content without any layouts or scripts
            $content = Yii::$app->controller->renderPartial('_reportView', [
                'atividade' => $atividade,
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
            $fileName = Util::generateHashSha256(6) . "_" . "atividade_" . $atividade->id . ".pdf";
            //Yii::$app->dumper->debug($path . $fileName, true);
            file_put_contents($path . $fileName, $pdf->render());

            $atividade->pdf = Atividade::PDF_PATH . $fileName;
            $atividade->save();
        }
    }

}
