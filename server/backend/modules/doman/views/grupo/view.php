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
$atividades = $model->getAtividades()->where(['deletado' => false])->all();
$dataProvider = new ArrayDataProvider([
    'allModels' => $atividades,
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
        'titulo',
        [
            'attribute' => 'tipo',
            'value' => function($data) {
                return Atividade::getTipoLabel($data->tipo);
            }
        ],
        [
            'label' => 'Qtd. Cartões',
            'contentOptions' => ['class' => 'text-right'],
            'value' => function($data) {
                if ($data->tipo == Atividade::TIPO_BIT_INTELIGENCIA) {
                    return $data->getCartoes()->where(['deletado' => false, 'status' => Cartao::STATUS_ACTIVE])->count();
                }
                return '';
            }
        ],
        [
            'attribute' => 'status',
            'value' => function($data) {
                return Atividade::getStatusLabel($data->status);
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'contentOptions' => ['class' => 'text-right'],
            'template' => '{view}',
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    return Url::to(['/doman/atividade/view', 'id' => $model->id]);
                }
            }
        ],
    ],
]);
?>
