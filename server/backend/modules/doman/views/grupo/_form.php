<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Grupo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grupo-form">

    <?php $form = ActiveForm::begin(); ?>
        
    <?= $form->errorSummary($model); ?>
    
     <div class="row">	
        <div class="col-lg-8">
            <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>
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
