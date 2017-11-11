<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Educador */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Educadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="educador-view">

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
            'nome',
            'email',
            [
                'attribute' => 'tipo',
                'value' => function($data) {
                    return app\modules\doman\models\Educador::getTipoLabel($data->tipo);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Educador::getStatusLabel($data->status);
                }
            ],
            'data_criacao:date',
        ],
    ])
    ?>

</div>
<p class="text-right">
    <?= Html::a('Associar Aluno', ['associar-aluno', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
</p>
<h3>Alunos Associados</h3>
<?php
$alunos = $model->getAlunos()->where(['deletado'=>false])->all();
$dataProvider = new ArrayDataProvider([
    'allModels' => $alunos,
    'sort' => [
        'attributes' => ['nome'],
    ],
    'pagination' => [
        'pageSize' => 10,
    ],
        ]);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'nome',
        'data_nascimento:date',
        [
            'attribute' => 'tipo',
            'value' => function($data) {
                return app\modules\doman\models\Aluno::getTipoLabel($data->tipo);
            }
        ],
        [
            'attribute' => 'status',
            'value' => function($data) {
                return app\modules\doman\models\Aluno::getStatusLabel($data->status);
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'contentOptions' => ['class' => 'text-right'],
            'template' => '{view}',
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    return Url::to(['/doman/aluno/view', 'id' => $model->id]);
                }
            }
        ],
    ],
]);
?>