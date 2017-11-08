<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Educador */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Educador'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="educador-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('translation', 'Educador').' '. Html::encode($this->title) ?></h2>
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
        'email:email',
        'tipo',
        'status',
        [
            'attribute' => 'user.username',
            'label' => Yii::t('translation', 'User'),
        ],
        'data_criacao',
        'deletado:boolean',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    
    <div class="row">
<?php
if($providerAtividadeAlunoNota->totalCount){
    $gridColumnAtividadeAlunoNota = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'atividadeAluno.id',
                'label' => Yii::t('translation', 'Atividade Aluno')
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
        'export' => false,
        'columns' => $gridColumnAtividadeAlunoNota
    ]);
}
?>

    </div>
    <div class="row">
        <h4>User<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnUser = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email:email',
        'status',
        'created_at',
        'updated_at',
        'name',
    ];
    echo DetailView::widget([
        'model' => $model->user,
        'attributes' => $gridColumnUser    ]);
    ?>
    
    <div class="row">
<?php
if($providerEducadorAluno->totalCount){
    $gridColumnEducadorAluno = [
        ['class' => 'yii\grid\SerialColumn'],
                        [
                'attribute' => 'aluno.id',
                'label' => Yii::t('translation', 'Aluno')
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
        'export' => false,
        'columns' => $gridColumnEducadorAluno
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerHistoricoAtividadeAluno->totalCount){
    $gridColumnHistoricoAtividadeAluno = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'atividade_aluno_id',
                        'data_atividade',
            'sessao',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerHistoricoAtividadeAluno,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-historico-atividade-aluno']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('translation', 'Historico Atividade Aluno')),
        ],
        'export' => false,
        'columns' => $gridColumnHistoricoAtividadeAluno
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerLicenca->totalCount){
    $gridColumnLicenca = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'data_inicio',
            'data_fim',
            'data_criacao',
            'tipo',
            'status',
            [
                'attribute' => 'user.username',
                'label' => Yii::t('translation', 'User')
            ],
            'deletado:boolean',
            'identificador',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerLicenca,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-licenca']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('translation', 'Licenca')),
        ],
        'export' => false,
        'columns' => $gridColumnLicenca
    ]);
}
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
        'export' => false,
        'columns' => $gridColumnPlanoEducadorLicenca
    ]);
}
?>

    </div>
</div>
