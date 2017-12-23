<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use common\models\Util;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Som */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="som-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'titulo')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?php
            $label = 'Arquivo';
            $label .= (!$model->isNewRecord) ? '  [ ' . Html::a(Util::fileRemovePath($model->caminho), $model->caminho, $options = ['target' => '_blank']) . ' ]' : '';
            echo $form->field($model, 'mp3')->label($label)->widget(FileInput::classname(), [
                'options' => ['accept' => 'audio/*'],
                'pluginOptions' => ['allowedFileExtensions' => ['mp3', 'wav'], 'showUpload' => false],
            ]);
            ?>
        </div>
        
        <div class="col-lg-1">

            <div class="form-group">
                <label class="control-label">&nbsp;</label>
                <?= Html::a("Gravar Som", './js/audiorecorder/index.html', ['target'=>'_blank', 'class' => 'btn btn-warning']) ?>
            </div>
            

        </div>

    </div><!-- /.row -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
