<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Educador */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'EducadorAluno', 
        'relID' => 'educador-aluno', 
        'value' => \yii\helpers\Json::encode($model->educadorAlunos),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Licenca', 
        'relID' => 'licenca', 
        'value' => \yii\helpers\Json::encode($model->licencas),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'PlanoEducadorLicenca', 
        'relID' => 'plano-educador-licenca', 
        'value' => \yii\helpers\Json::encode($model->planoEducadorLicencas),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="educador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true, 'placeholder' => 'Nome']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

    <?= $form->field($model, 'tipo')->textInput(['placeholder' => 'Tipo']) ?>

    <?= $form->field($model, 'status')->textInput(['placeholder' => 'Status']) ?>

    <?= $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\modules\doman\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('translation', 'Choose User')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'data_criacao')->textInput(['placeholder' => 'Data Criacao']) ?>

    <?= $form->field($model, 'deletado')->checkbox() ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('translation', 'EducadorAluno')),
            'content' => $this->render('_formEducadorAluno', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->educadorAlunos),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('translation', 'Licenca')),
            'content' => $this->render('_formLicenca', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->licencas),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('translation', 'PlanoEducadorLicenca')),
            'content' => $this->render('_formPlanoEducadorLicenca', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->planoEducadorLicencas),
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
