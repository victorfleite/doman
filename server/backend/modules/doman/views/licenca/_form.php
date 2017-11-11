<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Licenca */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="licenca-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    
    <div class="row">	
          <div class="col-lg-6">
            <?=
            $form->field($model, 'educador_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\modules\doman\models\Educador::find()->where(['deletado' => false])->orderBy('id')->asArray()->all(), 'id', 'nome'),
                'options' => ['placeholder' => Yii::t('translation', 'Selecione o Educador')],
                'pluginOptions' => [
                    'allowClear' => true,
                    'disabled'=>!$model->isNewRecord
                ],
            ]);
            ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'tipo')->dropDownList(\app\modules\doman\models\Licenca::getTipoCombo()); ?>
        </div>
        <div class="col-lg-4">
            <?=
            $form->field($model, 'data_inicio')->widget(\kartik\datecontrol\DateControl::classname(), [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => Yii::t('translation', 'Selecione a Data Início'),
                        'autoclose' => true
                    ]
                ],
            ]);
            ?>
        </div>
        <div class="col-lg-4">
            <?=
            $form->field($model, 'data_fim')->widget(\kartik\datecontrol\DateControl::classname(), [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => Yii::t('translation', 'Selecione a Data Fim'),
                        'autoclose' => true
                    ]
                ],
            ]);
            ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'status')->dropDownList(\app\modules\doman\models\Licenca::getStatusCombo()); ?>
        </div>
    </div>    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
