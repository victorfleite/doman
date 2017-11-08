<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Cartao */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Cartao'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cartao-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('translation', 'Cartao').' '. Html::encode($this->title) ?></h2>
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
        'status',
        'data_criacao',
        'ordem',
        [
            'attribute' => 'atividade.id',
            'label' => Yii::t('translation', 'Atividade'),
        ],
        'imagem_caminho',
        [
            'attribute' => 'user.username',
            'label' => Yii::t('translation', 'User'),
        ],
        'data_publicacao',
        [
            'attribute' => 'userPublicacao.username',
            'label' => Yii::t('translation', 'User Publicacao'),
        ],
        'deletado:boolean',
        'som_autoplay:boolean',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Atividade<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnAtividade = [
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
        'deletado:boolean',
        'tipo',
        'video_url',
        'autoplay',
        'som_id',
    ];
    echo DetailView::widget([
        'model' => $model->atividade,
        'attributes' => $gridColumnAtividade    ]);
    ?>
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
        'email',
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
        <h4>User<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnUser = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email',
        'status',
        'created_at',
        'updated_at',
        'name',
    ];
    echo DetailView::widget([
        'model' => $model->userPublicacao,
        'attributes' => $gridColumnUser    ]);
    ?>
    
    <div class="row">
<?php
if($providerCartaoAluno->totalCount){
    $gridColumnCartaoAluno = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'atividadeAluno.id',
                'label' => Yii::t('translation', 'Atividade Aluno')
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
        'export' => false,
        'columns' => $gridColumnCartaoAluno
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
                'attribute' => 'som.id',
                'label' => Yii::t('translation', 'Som')
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
