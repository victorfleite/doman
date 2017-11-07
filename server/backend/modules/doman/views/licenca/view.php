<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Licenca */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Licenca'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="licenca-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('translation', 'Licenca').' '. Html::encode($this->title) ?></h2>
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
        [
            'attribute' => 'educador.id',
            'label' => Yii::t('translation', 'Educador'),
        ],
        'data_inicio',
        'data_fim',
        'data_criacao',
        'tipo',
        'status',
        [
            'attribute' => 'user.username',
            'label' => Yii::t('translation', 'User'),
        ],
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
                'attribute' => 'plano.id',
                'label' => Yii::t('translation', 'Plano')
            ],
            [
                'attribute' => 'educador.id',
                'label' => Yii::t('translation', 'Educador')
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
</div>