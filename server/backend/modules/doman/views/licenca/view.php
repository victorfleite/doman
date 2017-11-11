<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Licenca */

$this->title = $model->identificador;
$this->params['breadcrumbs'][] = ['label' => 'Licencas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="licenca-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente apagar esta lincença?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => "<tr><th width='200px'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            [
                'attribute' => 'educador_id',
                'value' => function($data) {
                    return $data->educador->nome;
                }
            ],
             [
                'attribute' => 'tipo',
                'value' => function($data) {
                    return app\modules\doman\models\Licenca::getTipoLabel($data->tipo);
                }
            ],
            
            'data_inicio:date',
            'data_fim:date',
            'data_criacao:date',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Licenca::getStatusLabel($data->status);
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

</div>
