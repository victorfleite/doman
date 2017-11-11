<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Plano */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plano-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">	
        <div class="col-lg-6">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'ordem')->textInput(['type' => 'number']);
            ?>
        </div> 
        <div class="col-lg-4">
            <?= $form->field($model, 'status')->dropDownList(\app\modules\doman\models\Grupo::getStatusCombo()); ?>
        </div>         
    </div>
    <hr>
    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
