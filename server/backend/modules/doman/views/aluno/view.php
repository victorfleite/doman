<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Aluno */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('translation', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('translation', 'Are you sure you want to delete this item?'),
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
                    return Html::a(Html::img($data->imagem, ['width' => 80, 'height' => 80]), $data->imagem, $options = []);
                },
            ],
            'nome',
            'data_nascimento',
            'data_criacao:date',
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
    <?= Html::a('Associar Educador', ['associar-educador', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
</p>
<h3>Educador Associados</h3>
<?php
$educadores = $model->getEducadores()->where(['deletado'=>false])->all();
$dataProvider = new ArrayDataProvider([
    'allModels' => $educadores,
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
        ['class' => 'yii\grid\SerialColumn'],
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
        // 'user_id',
        // 'data_criacao',
        // 'deletado:boolean',
        [
            'class' => 'yii\grid\ActionColumn',
            'contentOptions' => ['class' => 'text-right'],
            'template' => '{view}',
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    return Url::to(['/doman/educador/view', 'id' => $model->id]);
                }
            }
        ],
    ],
]);
?>