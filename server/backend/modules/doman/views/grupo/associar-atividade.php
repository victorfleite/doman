<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\modules\doman\models\AssociarGrupoAtividadeForm;

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

    <h3>Grupo</h3>
    <?=
    DetailView::widget([
        'model' => $grupo,
        'template' => "<tr><th width='200px'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            [
                'attribute' => 'imagem',
                'format' => 'raw',
                'contentOptions' => [],
                'value' => function($data) {
                    return Html::a(Html::img($data->imagem, ['width' => 290, 'height' => 163]), $data->imagem, $options = ['target' => '_blank']);
                },
            ],
            'titulo',
            'descricao:ntext',
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->name;
                }
            ],
            'data_criacao:date',
            [
                'label' => 'Tags',
                'value' => function($data) {
                    $tags = [];
                    $list = $data->getTags()->all();
                    foreach($list as $item){
                        $tags[] = $item['name'];
                    }                
                    return implode($tags, ', ');
                }
            ],
            [
                'attribute' => 'inicializacao',
                'value' => function($data) {
                    return app\modules\doman\models\Grupo::getInicializacaoLabel($data->inicializacao);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Grupo::getStatusLabel($data->status);
                }
            ],
        ],
    ])
    ?>
    <?php
    $form = ActiveForm::begin();
    $form->field($model, 'grupo_id')->hiddenInput()->label(null);
    ?>

    <h3>Associar Atividade</h3>
    <div class="row">	
        <div class="col-lg-8">
            <?=
            $form->field($model, 'atividade_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => $model->getComboAtividade(),
                'options' => ['placeholder' => Yii::t('translation', 'Selecione a Atividade'), 'disabled'=>($model->scenario == AssociarGrupoAtividadeForm::SCENARIO_INSERT)? false: true],
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
        <?= Html::a(Yii::t('translation', 'Cancelar'), ['/doman/grupo/view', 'id' => $grupo->id], ['class' => 'btn btn-primary']) ?>	
        <?= Html::submitButton(Yii::t('translation', 'Salvar'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>