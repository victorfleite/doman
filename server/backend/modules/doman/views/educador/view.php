<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Educador */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Educadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="educador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente apagar este grupo?',
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

</div>
