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
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->name;
                }
            ],
            'data_criacao:date',
            [
                'label' => 'Tags',
                'value' => function($data) {
                    $tags = [];
                    $list = $data->getTags()->all();
                    foreach($list as $item){
                        $tags[] = $item['name'];
                    }                
                    return implode($tags, ', ');
                }
            ],
            [
                'attribute' => 'inicializacao',
                'value' => function($data) {
                    return app\modules\doman\models\Grupo::getInicializacaoLabel($data->inicializacao);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Grupo::getStatusLabel($data->status);
                }
            ],
        ],
    ])
    ?>

</div>

<p class="text-right">
    <?= Html::a('Associar Atividade', ['associar-atividade', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
</p>
<h3>Atividades Associadas</h3>
<?php
$relational = $model->getGrupoAtividades()->joinWith(['atividade' => function ($q) {
                $q->where(['deletado' => false]);
            }])->all();
$dataProvider = new ArrayDataProvider([
    'allModels' => $relational,
    'sort' => [
        'attributes' => ['ordem'],
        'defaultOrder' => ['ordem' => SORT_ASC]
    ],
    'pagination' => [
        'pageSize' => 10,
    ],
        ]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'imagem',
            'format' => 'raw',
            'contentOptions' => [],
            'value' => function($data) {
                return Html::a(Html::img($data->atividade->imagem, ['width' => 80, 'height' => 45]), Url::to(['/doman/atividade/view', 'id' => $data->atividade->id]), $options = []);
            },
        ],
        [
            'attribute' => 'titulo',
            'format' => 'raw',
            'value' => function($data) {
                $titulo = $data->atividade->titulo;
                if ($data->atividade->tipo == Atividade::TIPO_MIDIA_SOM) {
                    $audio = '<br><audio controls>';
                    $audio .= '     <source src="' . $data->atividade->som->caminho . '" type="audio/mpeg">';
                    $audio .= '     Your browser does not support the audio element.';
                    $audio .= '</audio>';
                    $titulo .= $audio;
                }
                if ($data->atividade->tipo == Atividade::TIPO_MIDIA_YOUTUBE) {
                    $audio = '<br><a href="' . $data->atividade->video_url . '" target="_blank">' . $data->atividade->video_url . '</a>';
                    $titulo .= $audio;
                }
                return $titulo;
            }
        ],
        [
            'label' => 'Tipo',
            'value' => function($data) {
                return Atividade::getTipoLabel($data->atividade->tipo);
            }
        ],
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
            'attribute' => 'ordem',
            'contentOptions' => ['class' => 'text-right'],
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
            'template' => '{view} {update} {delete}',
            'urlCreator' => function ($action, $data, $key, $index) {
                if ($action === 'view') {
                    return Url::to(['/doman/atividade/view', 'id' => $data->atividade->id]);
                }
                if ($action === 'update') {
                    return Url::to(['/doman/grupo/editar-associacao-atividade', 'id' => $data->grupo->id, 'atividade_id' => $data->atividade->id, 'ordem' => $data->ordem]);
                }
                if ($action === 'delete') {
                    return Url::to(['/doman/grupo/delete-atividade', 'id' => $data->grupo->id, 'atividade_id' => $data->atividade->id]);
                }
            }
        ],
    ],
]);
?>
