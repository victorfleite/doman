<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Atividade */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Atividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atividade-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente apagar esta atividade?',
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
            'titulo',
            [
                'attribute' => 'tipo',
                'value' => function($data) {
                    return app\modules\doman\models\Atividade::getTipoLabel($data->tipo);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Atividade::getStatusLabel($data->status);
                }
            ],
            'data_criacao:date',
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->name;
                }
            ],
            'video_url:url',
            [
                'attribute' => 'som_id',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a($data->som->caminho, $data->som->caminho, $options = ['target' => '_blank']);
                },
            ],
            'autoplay:boolean',
        ],
    ])
    ?>

</div>
