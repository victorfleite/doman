<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Atividade */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Atividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atividade-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente apagar esta atividade?',
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
            [
                'attribute' => 'tipo',
                'value' => function($data) {
                    return app\modules\doman\models\Atividade::getTipoLabel($data->tipo);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Atividade::getStatusLabel($data->status);
                }
            ],
            'data_criacao:date',
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->name;
                }
            ],
            'video_url:url',
            [
                'attribute' => 'som_id',
                'format' => 'raw',
                'value' => function($data) {
                    if (empty($data->som_id))
                        return '';
                    $audio = '<audio controls>';
                    $audio .= '     <source src="' . $data->som->caminho . '" type="audio/mpeg">';
                    $audio .= '     Your browser does not support the audio element.';
                    $audio .= '</audio>';
                    return $audio;
                },
            ],
        ],
    ])
    ?>

</div>
<h2>Descrição</h1>
<p class="text-justify"><?php echo (!empty($model->descricao))?$model->descricao:'Sem descrição'; ?></p>

<?php if ($model->tipo == \app\modules\doman\models\Atividade::TIPO_BIT_INTELIGENCIA) { ?>

    <p class="text-right">
    <?= Html::a('Novo Cartao', ['/doman/cartao/create', 'atividade_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $cartoesDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'imagem_caminho',
                'format' => 'raw',
                'contentOptions' => [],
                'value' => function($data) {
                    return Html::a(Html::img($data->imagem_caminho, ['width' => 80, 'height' => 60]), $data->imagem_caminho, $options = ['target' => '_blank']);
                },
            ],
            'nome',
            [
                'attribute' => 'ordem',
                'contentOptions' => ['class' => 'text-right']
            ],
            [
                'attribute' => 'status_convocacao',
                'value' => function($data) {
                    return app\modules\doman\models\Cartao::getStatusConvocacaoLabel($data->status_convocacao);
                }
            ],
            [
                'attribute' => 'som_id',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data->som_id) {
                        $titulo = $data->som->titulo;

                        $audio = '<br><audio controls>';
                        $audio .= '     <source src="' . $data->som->caminho . '" type="audio/mpeg">';
                        $audio .= '     Your browser does not support the audio element.';
                        $audio .= '</audio>';
                        $titulo .= $audio;

                        return $titulo;
                    }
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Cartao::getStatusLabel($data->status);
                }
            ],
            // 'atividade_id',
            // 'imagem_caminho',
            // 'user_id',
            // 'data_publicacao',
            // 'user_publicacao_id',
            // 'deletado:boolean',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'text-right'],
                'template' => '{view} {update} {delete}',
                'urlCreator' => function ($action, $data, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['/doman/cartao/view', 'id' => $data->id, 'atividade_id' => $data->atividade_id]);
                    }
                    if ($action === 'update') {
                        return Url::to(['/doman/cartao/update', 'id' => $data->id, 'atividade_id' => $data->atividade_id]);
                    }
                    if ($action === 'delete') {
                        return Url::to(['/doman/cartao/delete', 'id' => $data->id, 'atividade_id' => $data->atividade_id]);
                    }
                }
            ],
        ],
    ]);
}
?>
