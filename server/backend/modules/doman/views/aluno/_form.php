<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use common\models\Util;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Aluno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aluno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>            
            <?=
            $form->field($model, 'data_nascimento')->widget(\kartik\datecontrol\DateControl::classname(), [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => Yii::t('translation', 'Selecione a Data Nascimento'),
                        'autoclose' => true
                    ]
                ],
            ]);
            ?>
            <?= $form->field($model, 'tipo')->dropDownList(\app\modules\doman\models\Aluno::getTipoCombo()); ?>
            <?= $form->field($model, 'sexo')->dropDownList(\app\modules\doman\models\Aluno::getSexoCombo()); ?>
            <?= $form->field($model, 'status')->dropDownList(\app\modules\doman\models\Aluno::getStatusCombo()); ?>
        </div>
        <div class="col-lg-6">
            <?php
            $label = 'Arquivo - largura:128px, altura: 128px (.jpg ou .png)';
            $label .= (!$model->isNewRecord) ? '  [ ' . Html::a(Util::fileRemovePath($model->imagem), $model->imagem, $options = ['target' => '_blank']) . ' ]' : '';
            echo $form->field($model, 'image')->label($label)->widget(FileInput::classname(), [
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
