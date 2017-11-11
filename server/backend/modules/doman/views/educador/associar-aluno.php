<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\modules\doman\models\Aluno;
use softark\duallistbox\DualListbox;

/* @var $this yii\web\View */
/* @var $model backend\models\Workgroup */
/*$this->title = Yii::t('translation', 'recipient.associate_recipient_title');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.administration_menu_label');
$this->params['breadcrumbs'][] = Yii::t('translation', 'menu.communication_menu_label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $group->name, 'url' => ['view', 'id' => $group->id]];
$this->params['breadcrumbs'][] = $this->title*/
?>
<div class="grupo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class='text-right'>
	<?= Html::a('Editar', ['/doman/educador/update', 'id' => $educador->id], ['class' => 'btn btn-primary']) ?>
    </p>


    <h3>Educador</h3>
    <?=
    DetailView::widget([
        'model' => $educador,
        'template' => "<tr><th width='200px'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            'nome',
            'email',
            [
                'attribute' => 'tipo',
                'value' => function($data) {
                    return app\modules\doman\models\Educador::getTipoLabel($data->tipo);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Educador::getStatusLabel($data->status);
                }
            ],
            'data_criacao:date',
        ],
    ])
    ?>
    <?php 
    $form = ActiveForm::begin();
    ?>
    <h3>Alunos Associados</h3>
    <div>

	<?php
	$options = [
	    'multiple' => true,
	    'size' => 20,
	];
	$alunosAvailable = app\modules\doman\models\Aluno::find()->where(['deletado'=>false])->orderBy('nome')->asArray()->all();
	$items = ArrayHelper::map($alunosAvailable, 'id', 'nome');
	// echo $form->field($model, $attribute)->listBox($items, $options);
	echo $form->field($model, 'alunos')->label('')->widget(DualListbox::className(), [
	    'items' => $items,
	    'options' => $options,
	    'clientOptions' => [
		'moveOnSelect' => false,
		'selectedListLabel' => "Associados",
		'nonSelectedListLabel' => "Não Associados",
	    ],
	]);
	?>

    </div>
    <p>&nbsp;</p>
    <div class="form-group">
	<?= Html::a(Yii::t('translation', 'Cancel'), ['/doman/educador/view', 'id'=>$educador->id], ['class' => 'btn btn-primary']) ?>	
	<?= Html::submitButton(Yii::t('translation', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>


</div>