<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Cartao */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Atividades', 'url' => ['/doman/atividade/index']];
$this->params['breadcrumbs'][] = ['label' => $model->atividade->titulo, 'url' => ['/doman/atividade/view', 'id' => $model->atividade_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cartao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Editar', ['update', 'id' => $model->id, 'atividade_id' => $model->atividade_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Apagar', ['delete', 'id' => $model->id, 'atividade_id' => $model->atividade_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente apagar este cartão?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'template' => "<tr><th width='200px'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            [
                'attribute' => 'imagem_caminho',
                'format' => 'raw',
                'contentOptions' => [],
                'value' => function($data) {
                    return Html::a(Html::img($data->imagem_caminho, ['width' => 400, 'height' => 300]), $data->imagem_caminho, $options = ['target' => '_blank']);
                },
            ],
            'nome',
            [
                'attribute' => 'atividade_id',
                'value' => function($data) {
                    return $data->atividade->titulo;
                }
            ],
            [
                'attribute' => 'status_convocacao',
                'value' => function($data) {
                    return app\modules\doman\models\Cartao::getStatusConvocacaoLabel($data->status_convocacao);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Cartao::getStatusLabel($data->status);
                }
            ],
            'data_criacao:date',
            'ordem',
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->name;
                }
            ],
        ],
    ])
    ?>

</div>
