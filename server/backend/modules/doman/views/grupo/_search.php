<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\GrupoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grupo-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="row">
        <div class="col-lg-8">
            <?= $form->field($model, 'titulo') ?>
        </div>
        <div class="col-lg-4">
<?= $form->field($model, 'status')->dropDownList(\app\modules\doman\models\Grupo::getStatusCombo(), ['prompt' => 'Selecione']); ?>
        </div> 
    </div>

    <div class="form-group">
    <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
