<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Som */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Sons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="som-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Novo', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente apagar este som?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'titulo',
            [
                'attribute' => 'caminho',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a($data->caminho, $data->caminho, $options = ['target' => '_blank']);
                },
            ],
        ],
    ])
    ?>

</div>
