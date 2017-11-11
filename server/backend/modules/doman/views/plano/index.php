<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Planos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p  class="text-right">
        <?= Html::a('Novo Plano', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nome',
            'data_criacao:date',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Plano::getStatusLabel($data->status);
                }
            ],
            // 'user_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'text-right']
            ],
        ],
    ]);
    ?>
</div>
