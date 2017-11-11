<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\modules\doman\models\Educador;
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
	<?= Html::a('Editar', ['/doman/aluno/update', 'id' => $aluno->id], ['class' => 'btn btn-primary']) ?>
    </p>


    <h3>Aluno</h3>
    <?= DetailView::widget([
        'model' => $aluno,
        'template' => "<tr><th width='200px'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            'nome',
            'data_nascimento',
            'data_criacao:date',
            [
                'attribute' => 'tipo',
                'value' => function($data) {
                    return app\modules\doman\models\Aluno::getTipoLabel($data->tipo);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Aluno::getStatusLabel($data->status);
                }
            ],
                    [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->name;
                }
            ],
        ],
    ]) ?>
    <?php 
    $form = ActiveForm::begin();
    ?>
    <h3>Educadores Associados</h3>
    <div>

	<?php
	$options = [
	    'multiple' => true,
	    'size' => 20,
	];
	$educadoresAvailable = app\modules\doman\models\Educador::find()->where(['deletado'=>false])->orderBy('nome')->asArray()->all();
	$items = ArrayHelper::map($educadoresAvailable, 'id', 'nome');
	// echo $form->field($model, $attribute)->listBox($items, $options);
	echo $form->field($model, 'educadores')->label('')->widget(DualListbox::className(), [
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
	<?= Html::a(Yii::t('translation', 'Cancel'), ['/doman/aluno/view', 'id'=>$aluno->id], ['class' => 'btn btn-primary']) ?>	
	<?= Html::submitButton(Yii::t('translation', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>


</div>