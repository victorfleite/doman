<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Grupo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Grupo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('translation', 'Grupo').' '. Html::encode($this->title) ?></h2>
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
        'descricao:ntext',
        'status',
        [
            'attribute' => 'user.username',
            'label' => Yii::t('translation', 'User'),
        ],
        'data_criacao',
        'data_publicacao',
        [
            'attribute' => 'userPublicacao.username',
            'label' => Yii::t('translation', 'User Publicacao'),
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
if($providerAtividadeAluno->totalCount){
    $gridColumnAtividadeAluno = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'atividade.id',
                'label' => Yii::t('translation', 'Atividade')
            ],
            [
                'attribute' => 'aluno.grupo_id',
                'label' => Yii::t('translation', 'Aluno')
            ],
            'status',
            [
                'attribute' => 'atividadePai.id',
                'label' => Yii::t('translation', 'Atividade Pai')
            ],
            'data_criacao',
                        'data_abertura',
            'data_finalizacao',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerAtividadeAluno,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-atividade-aluno']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('translation', 'Atividade Aluno')),
        ],
        'columns' => $gridColumnAtividadeAluno
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerGrupoAluno->totalCount){
    $gridColumnGrupoAluno = [
        ['class' => 'yii\grid\SerialColumn'],
                        [
                'attribute' => 'aluno.id',
                'label' => Yii::t('translation', 'Aluno')
            ],
                        'status',
            'data_abertura',
            'data_finalizacao',
            'data_criacao',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerGrupoAluno,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-grupo-aluno']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('translation', 'Grupo Aluno')),
        ],
        'columns' => $gridColumnGrupoAluno
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerGrupoAtividade->totalCount){
    $gridColumnGrupoAtividade = [
        ['class' => 'yii\grid\SerialColumn'],
                        [
                'attribute' => 'atividade.id',
                'label' => Yii::t('translation', 'Atividade')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerGrupoAtividade,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-grupo-atividade']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('translation', 'Grupo Atividade')),
        ],
        'columns' => $gridColumnGrupoAtividade
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
                'attribute' => 'plano.id',
                'label' => Yii::t('translation', 'Plano')
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