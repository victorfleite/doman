<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Plano */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Plano'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('translation', 'Plano').' '. Html::encode($this->title) ?></h2>
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
        'nome',
        'descricao:ntext',
        'status',
        'data_criacao',
        'user_id',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerPlanoEducadorLicenca->totalCount){
    $gridColumnPlanoEducadorLicenca = [
        ['class' => 'yii\grid\SerialColumn'],
                        [
                'attribute' => 'educador.id',
                'label' => Yii::t('translation', 'Educador')
            ],
            [
                'attribute' => 'licenca.id',
                'label' => Yii::t('translation', 'Licenca')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPlanoEducadorLicenca,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-plano-educador-licenca']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('translation', 'Plano Educador Licenca')),
        ],
        'columns' => $gridColumnPlanoEducadorLicenca
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerPlanoGrupo->totalCount){
    $gridColumnPlanoGrupo = [
        ['class' => 'yii\grid\SerialColumn'],
                        [
                'attribute' => 'grupo.id',
                'label' => Yii::t('translation', 'Grupo')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPlanoGrupo,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-plano-grupo']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('translation', 'Plano Grupo')),
        ],
        'columns' => $gridColumnPlanoGrupo
    ]);
}
?>
    </div>
</div>