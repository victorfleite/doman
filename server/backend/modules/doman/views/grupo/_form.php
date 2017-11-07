<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Grupo */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'AtividadeAluno', 
        'relID' => 'atividade-aluno', 
        'value' => \yii\helpers\Json::encode($model->atividadeAlunos),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'GrupoAluno', 
        'relID' => 'grupo-aluno', 
        'value' => \yii\helpers\Json::encode($model->grupoAlunos),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'GrupoAtividade', 
        'relID' => 'grupo-atividade', 
        'value' => \yii\helpers\Json::encode($model->grupoAtividades),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'PlanoGrupo', 
        'relID' => 'plano-grupo', 
        'value' => \yii\helpers\Json::encode($model->planoGrupos),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="grupo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true, 'placeholder' => 'Titulo']) ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput(['placeholder' => 'Status']) ?>

    <?= $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\modules\doman\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('translation', 'Choose User')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'data_criacao')->textInput(['placeholder' => 'Data Criacao']) ?>

    <?= $form->field($model, 'data_publicacao')->textInput(['placeholder' => 'Data Publicacao']) ?>

    <?= $form->field($model, 'user_publicacao_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\modules\doman\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('translation', 'Choose User')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('translation', 'AtividadeAluno')),
            'content' => $this->render('_formAtividadeAluno', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->atividadeAlunos),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('translation', 'GrupoAluno')),
            'content' => $this->render('_formGrupoAluno', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->grupoAlunos),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('translation', 'GrupoAtividade')),
            'content' => $this->render('_formGrupoAtividade', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->grupoAtividades),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('translation', 'PlanoGrupo')),
            'content' => $this->render('_formPlanoGrupo', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->planoGrupos),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
