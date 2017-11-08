<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Som */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Som'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="som-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('translation', 'Som').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('translation', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('translation', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'titulo',
        'caminho',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    
    <div class="row">
<?php
if($providerAtividade->totalCount){
    $gridColumnAtividade = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'titulo',
            'status',
            'data_publicacao',
            'data_criacao',
            [
                'attribute' => 'user.username',
                'label' => Yii::t('translation', 'User')
            ],
            [
                'attribute' => 'userPublicacao.username',
                'label' => Yii::t('translation', 'User Publicacao')
            ],
            'deletado:boolean',
            'tipo',
            'video_url:url',
            'autoplay:boolean',
                ];
    echo Gridview::widget([
        'dataProvider' => $providerAtividade,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-atividade']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('translation', 'Atividade')),
        ],
        'export' => false,
        'columns' => $gridColumnAtividade
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerCartaoSom->totalCount){
    $gridColumnCartaoSom = [
        ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'cartao.id',
                'label' => Yii::t('translation', 'Cartao')
            ],
                ];
    echo Gridview::widget([
        'dataProvider' => $providerCartaoSom,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-cartao-som']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('translation', 'Cartao Som')),
        ],
        'export' => false,
        'columns' => $gridColumnCartaoSom
    ]);
}
?>

    </div>
</div>
