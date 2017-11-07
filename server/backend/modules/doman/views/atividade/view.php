<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Atividade */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Atividade'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atividade-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('translation', 'Atividade').' '. Html::encode($this->title) ?></h2>
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
        'status',
        'data_publicacao',
        'data_criacao',
        [
            'attribute' => 'user.username',
            'label' => Yii::t('translation', 'User'),
        ],
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
                'attribute' => 'aluno.grupo_id',
                'label' => Yii::t('translation', 'Aluno')
            ],
            'status',
            [
                'attribute' => 'atividadePai.id',
                'label' => Yii::t('translation', 'Atividade Pai')
            ],
            'data_criacao',
            [
                'attribute' => 'grupo.id',
                'label' => Yii::t('translation', 'Grupo')
            ],
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
if($providerCartao->totalCount){
    $gridColumnCartao = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'nome',
            'status',
            'data_criacao',
            'ordem',
                        'imagem_caminho',
            'som_caminho',
            [
                'attribute' => 'user.username',
                'label' => Yii::t('translation', 'User')
            ],
            'data_publicacao',
            [
                'attribute' => 'userPublicacao.username',
                'label' => Yii::t('translation', 'User Publicacao')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCartao,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-cartao']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('translation', 'Cartao')),
        ],
        'columns' => $gridColumnCartao
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
                'attribute' => 'grupo.id',
                'label' => Yii::t('translation', 'Grupo')
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
</div>