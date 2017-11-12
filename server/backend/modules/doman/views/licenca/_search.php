<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\LicencaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="licenca-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="row">
        <div class="col-lg-4">
            <?php echo $form->field($model, 'identificador')  ?>
        </div>        
        <div class="col-lg-4">
            <?=
            $form->field($model, 'educador_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\modules\doman\models\Educador::find()->where(['deletado' => false])->orderBy('id')->asArray()->all(), 'id', 'nome'),
                'options' => ['placeholder' => Yii::t('translation', 'Selecione o Educador')],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'tipo')->dropDownList(\app\modules\doman\models\Licenca::getTipoCombo(), ['prompt' => 'Selecione']); ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'status')->dropDownList(\app\modules\doman\models\Licenca::getStatusCombo(), ['prompt' => 'Selecione']); ?>
        </div>
    </div>    
       

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
