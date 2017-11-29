<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use common\models\Util;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Atividade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atividade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">	
        <div class="col-lg-6">
            <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'tipo')->dropDownList(\app\modules\doman\models\Atividade::getTipoCombo(), ['disabled' => !$model->isNewRecord]); ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'status')->dropDownList(\app\modules\doman\models\Atividade::getStatusCombo()); ?>
        </div>
    </div>
    <div class="row">	
        <div class="col-lg-8">
            <?= $form->field($model, 'video_url')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?=
            $form->field($model, 'som_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\modules\doman\models\Som::find()->orderBy('id')->asArray()->all(), 'id', 'titulo'),
                'options' => ['placeholder' => Yii::t('translation', 'Selecione o Som')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-6"><?= $form->field($model, 'descricao')->textarea(['rows' => 15]) ?></div>
        <div class="col-lg-6">
            <?php
            $label = 'Arquivo - largura:600px, altura: 338px (.jpg ou .png)';
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
