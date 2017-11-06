<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cartaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cartao-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cartao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'status',
            'data_criacao',
            'ordem',
            // 'atividade_id',
            // 'imagem_caminho',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
