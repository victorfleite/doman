<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Plano */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Planos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente apagar este plano?',
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
            'nome',
            'descricao:ntext',
            'data_criacao:date',
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
        ],
    ])
    ?>

</div>

<p class="text-right">
    <?= Html::a('Associar Grupo', ['associar-grupo', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
</p>
<h3>Grupos Associados</h3>
<?php
$grupos = $model->getGrupos()->where(['deletado' => false])->all();
$dataProvider = new ArrayDataProvider([
    'allModels' => $grupos,
    'sort' => [
        'attributes' => ['titulo'],
    ],
    'pagination' => [
        'pageSize' => 10,
    ],
        ]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'titulo',
        [
            'attribute' => 'grupo_pai',
            'value' => function($data) {
                return $data->grupoPai->titulo;
            }
        ],
        [
            'label' => 'Qtd. Atividades',
            'contentOptions' => ['class' => 'text-right'],
            'value' => function($data) {
                return $data->getAtividades()->where(['deletado' => false])->count();
            }
        ],
        [
            'attribute' => 'ordem',
            'contentOptions' => ['class' => 'text-right']
        ],
        [
            'attribute' => 'status',
            'value' => function($data) {
                return app\modules\doman\models\Grupo::getStatusLabel($data->status);
            }
        ],
        //'user_id',
        // 'data_criacao',
        // 'data_publicacao',
        // 'user_publicacao_id',
        // 'deletado:boolean',
        [
            'class' => 'yii\grid\ActionColumn',
            'contentOptions' => ['class' => 'text-right'],
            'template' => '{view}',
            'urlCreator' => function ($action, $data, $key, $index) {
                if ($action === 'view') {
                    return Url::to(['/doman/grupo/view', 'id' => $data->id]);
                }
                if ($action === 'update') {
                    return Url::to(['/doman/grupo/update', 'id' => $data->id]);
                }
                if ($action === 'delete') {
                    return Url::to(['/doman/grupo/delete', 'id' => $data->id]);
                }
            }
        ],
    ],
]);
?>