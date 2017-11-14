<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\AlunoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aluno-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="row">	
        <div class="col-lg-3">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
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
        </div>
         <div class="col-lg-2">
            <?= $form->field($model, 'sexo')->dropDownList(\app\modules\doman\models\Aluno::getSexoCombo(), ['prompt'=>'Selecione']); ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'tipo')->dropDownList(\app\modules\doman\models\Aluno::getTipoCombo(), ['prompt'=>'Selecione']); ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'status')->dropDownList(\app\modules\doman\models\Aluno::getStatusCombo(), ['prompt'=>'Selecione']); ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
