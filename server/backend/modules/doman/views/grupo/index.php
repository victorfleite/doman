<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grupos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
        <?= Html::a('Novo Grupo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
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
                'template' => '{associar} {view} {update} {delete}',
                'buttons' => [
                    'associar' => function ($url) {
                        return Html::a(
                                        '<span class="glyphicon glyphicon glyphicon-plus-sign"></span>', $url, [
                                    'title' => 'Associar Atividade',
                                        ]
                        );
                    },
                ],
                'urlCreator' => function ($action, $data, $key, $index) {
                    if ($action === 'associar') {
                        return Url::to(['/doman/grupo/associar-atividade', 'id' => $data->id]);
                    }                   
                }
            ],
        ],
    ]);
    ?>
</div>
