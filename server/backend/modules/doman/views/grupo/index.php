<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grupos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Novo Grupo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'titulo',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Plano::getStatusLabel($data->status);
                }
            ],
            //'user_id',
            // 'data_criacao',
            // 'data_publicacao',
            // 'user_publicacao_id',
            // 'deletado:boolean',
            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'text-right']
            ],
        ],
    ]);
    ?>
</div>
