<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\EducadorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="educador-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

     <div class="row">	
        <div class="col-lg-5">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        </div>
         <div class="col-lg-3">
             <?= $form->field($model, 'email') ?>
         </div>
         <div class="col-lg-2">
            <?= $form->field($model, 'tipo')->dropDownList(\app\modules\doman\models\Educador::getTipoCombo(), ['prompt'=>'Selecione']); ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'status')->dropDownList(\app\modules\doman\models\Educador::getStatusCombo(), ['prompt'=>'Selecione']); ?>
        </div>
     </div>    
    

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
