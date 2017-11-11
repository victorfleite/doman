<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use common\models\Util;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Cartao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cartao-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">	
        <div class="col-lg-6">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'status_convocacao')->dropDownList(\app\modules\doman\models\Cartao::getStatusConvocacaoCombo()); ?>
        </div> 
        <div class="col-lg-2">
            <?= $form->field($model, 'ordem')->textInput(['type' => 'number']); ?>
        </div> 
        <div class="col-lg-2">
            <?= $form->field($model, 'status')->dropDownList(\app\modules\doman\models\Cartao::getStatusCombo()); ?>
        </div>         
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php
            $label = 'Arquivo';
            $label .= (!$model->isNewRecord) ? '  [ ' . Html::a(Util::fileRemovePath($model->imagem_caminho), $model->imagem_caminho, $options = ['target' => '_blank']) . ' ]' : '';
            echo $form->field($model, 'imagem')->label($label)->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => ['allowedFileExtensions' => ['jpg', 'png'], 'showUpload' => false],
            ]);
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
