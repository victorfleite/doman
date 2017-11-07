<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Aluno */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Aluno'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('translation', 'Aluno').' '. Html::encode($this->title) ?></h2>
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
        'data_nascimento',
        'tipo',
        [
            'attribute' => 'user.username',
            'label' => Yii::t('translation', 'User'),
        ],
        'data_criacao',
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
if($providerEducadorAluno->totalCount){
    $gridColumnEducadorAluno = [
        ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'educador.id',
                'label' => Yii::t('translation', 'Educador')
            ],
                        'data_criacao',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEducadorAluno,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-educador-aluno']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('translation', 'Educador Aluno')),
        ],
        'columns' => $gridColumnEducadorAluno
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
                'attribute' => 'grupo.id',
                'label' => Yii::t('translation', 'Grupo')
            ],
                        [
                'attribute' => 'grupoPai.id',
                'label' => Yii::t('translation', 'Grupo Pai')
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
</div>