<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atividades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atividade-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Nova Atividade', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
            //'data_publicacao',
            //'data_criacao',
            // 'user_id',
            // 'user_publicacao_id',
            // 'deletado:boolean',
            // 'tipo',
            // 'video_url:url',
            // 'autoplay:boolean',
            // 'som_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'text-right'],
            ],
        ],
    ]);
    ?>
</div>
