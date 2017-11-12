<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;
use app\modules\doman\models\Atividade;
use app\modules\doman\models\Cartao;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Grupo */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente apagar este grupo?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'template' => "<tr><th width='200px'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
             [
                'attribute' => 'imagem',
                'format' => 'raw',
                'contentOptions' => [],
                'value' => function($data) {
                    return Html::a(Html::img($data->imagem, ['width' => 290, 'height' => 163]), $data->imagem, $options = ['target' => '_blank']);
                },
            ],
            'titulo',
            'descricao:ntext',
            [
                'attribute' => 'grupo_pai',
                'value' => function($data) {
                    return $data->grupoPai->titulo;
                }
            ],
            'ordem',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Grupo::getStatusLabel($data->status);
                }
            ],
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->name;
                }
            ],
            'data_criacao:date',
        ],
    ])
    ?>

</div>

<p class="text-right">
    <?= Html::a('Associar Atividade', ['associar-atividade', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
</p>
<h3>Atividades Associadas</h3>
<?php
$relational = $model->getGrupoAtividades()->all();
$dataProvider = new ArrayDataProvider([
    'allModels' => $relational,
    'sort' => [
        'attributes' => ['ordem'],
    ],
    'pagination' => [
        'pageSize' => 10,
    ],
        ]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'label' => 'Título',
            'value' => function($data) {
                return $data->atividade->titulo;
            }
        ],
        [
            'label' => 'Tipo',
            'value' => function($data) {
                return Atividade::getTipoLabel($data->atividade->tipo);
            }
        ],
        'ordem',
        [
            'label' => 'Qtd. Cartões',
            'contentOptions' => ['class' => 'text-right'],
            'value' => function($data) {
                if ($data->atividade->tipo == Atividade::TIPO_BIT_INTELIGENCIA) {
                    return $data->atividade->getCartoes()->where(['deletado' => false, 'status' => Cartao::STATUS_ACTIVE])->count();
                }
                return '';
            }
        ],
        [
            'attribute' => 'status',
            'value' => function($data) {
                return Atividade::getStatusLabel($data->atividade->status);
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'contentOptions' => ['class' => 'text-right'],
            'template' => '{view}',
            'urlCreator' => function ($action, $data, $key, $index) {
                if ($action === 'view') {
                    return Url::to(['/doman/atividade/view', 'id' => $data->atividade->id]);
                }
                if ($action === 'update') {
                    return Url::to(['/doman/grupo/editar-associacao-atividade', 'id' => $data->grupo->id, 'atividade_id' => $data->atividade->id, 'ordem' => $data->ordem]);
                }
                if ($action === 'delete') {
                    return Url::to(['/doman/atividade/delete', 'id' => $data->atividade->id]);
                }
            }
        ],
    ],
]);
?>
