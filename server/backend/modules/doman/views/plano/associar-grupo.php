<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\modules\doman\models\AssociarPlanoGrupoForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Workgroup */
/* $this->title = Yii::t('translation', 'recipient.associate_recipient_title');
  $this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
  $this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
  $this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'groups'), 'url' => ['index']];
  $this->params['breadcrumbs'][] = ['label' => $group->name, 'url' => ['view', 'id' => $group->id]];
  $this->params['breadcrumbs'][] = $this->title */
?>
<div class="grupo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <h3>Plano</h3>
    <?=
    DetailView::widget([
        'model' => $plano,
        'template' => "<tr><th width='200px'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            'nome',
            'descricao:ntext',
            'data_criacao:date',
            'ordem',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Grupo::getStatusLabel($data->status);
                }
            ],
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->name;
                }
            ],
        ],
    ])
    ?>
    <?php
    $form = ActiveForm::begin();
    $form->field($model, 'plano_id')->hiddenInput()->label(null);
    ?>

    <h3>Associar Grupo</h3>
    <div class="row">	
        <div class="col-lg-8">
            <?=
            $form->field($model, 'grupo_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => $model->getComboGrupos(),
                'options' => ['placeholder' => Yii::t('translation', 'Selecione o Grupo'), 'disabled'=>($model->scenario == AssociarPlanoGrupoForm::SCENARIO_INSERT)? false: true],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'ordem')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <p>&nbsp;</p>
    <div class="form-group">
        <?= Html::a(Yii::t('translation', 'Cancel'), ['/doman/plano/view', 'id' => $plano->id], ['class' => 'btn btn-primary']) ?>	
        <?= Html::submitButton(Yii::t('translation', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>