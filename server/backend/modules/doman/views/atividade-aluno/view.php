<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\AtividadeAluno */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Atividade Aluno'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atividade-aluno-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('translation', 'Atividade Aluno').' '. Html::encode($this->title) ?></h2>
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
            'attribute' => 'atividade.id',
            'label' => Yii::t('translation', 'Atividade'),
        ],
        [
            'attribute' => 'aluno.grupo_id',
            'label' => Yii::t('translation', 'Aluno'),
        ],
        'status',
        [
            'attribute' => 'atividadePai.id',
            'label' => Yii::t('translation', 'Atividade Pai'),
        ],
        'data_criacao',
        [
            'attribute' => 'grupo.id',
            'label' => Yii::t('translation', 'Grupo'),
        ],
        'data_abertura',
        'data_finalizacao',
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
if($providerAtividadeAlunoNota->totalCount){
    $gridColumnAtividadeAlunoNota = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'educador.id',
                'label' => Yii::t('translation', 'Educador')
            ],
            'nota',
            'data_criacao',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerAtividadeAlunoNota,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-atividade-aluno-nota']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('translation', 'Atividade Aluno Nota')),
        ],
        'columns' => $gridColumnAtividadeAlunoNota
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerCartaoAluno->totalCount){
    $gridColumnCartaoAluno = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'cartao.id',
                'label' => Yii::t('translation', 'Cartao')
            ],
            'transacao_status',
            'conhecido',
            'data_conhecimento',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCartaoAluno,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-cartao-aluno']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('translation', 'Cartao Aluno')),
        ],
        'columns' => $gridColumnCartaoAluno
    ]);
}
?>
    </div>
</div>