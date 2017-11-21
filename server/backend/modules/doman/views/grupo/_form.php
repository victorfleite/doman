<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use common\models\Util;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Grupo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grupo-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">	
        <div class="col-lg-4">
            <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?=
            $form->field($model, 'tagNames')->widget(dosamigos\selectize\SelectizeTextInput::className(), [
                'loadUrl' => ['tag/list'],
                'options' => ['class' => 'form-control'],
                'clientOptions' => [
                    'plugins' => ['remove_button'],
                    'valueField' => 'name',
                    'labelField' => 'name',
                    'searchField' => ['name'],
                    'create' => true,
                ],
            ]);
            ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'inicializacao')->dropDownList(\app\modules\doman\models\Grupo::getInicializacaoCombo()); ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'status')->dropDownList(\app\modules\doman\models\Grupo::getStatusCombo()); ?>
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
