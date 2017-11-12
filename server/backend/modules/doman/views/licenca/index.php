<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Licenças';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="licenca-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
        <?= Html::a('Nova Licença', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'identificador',
            [
                'attribute' => 'educador_id',
                'value' => function($data) {
                    return $data->educador->nome;
                }
            ],
            [
                'attribute' => 'tipo',
                'value' => function($data) {
                    return app\modules\doman\models\Licenca::getTipoLabel($data->tipo);
                }
            ],
            'data_inicio:date',
            'data_fim:date',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return app\modules\doman\models\Licenca::getStatusLabel($data->status);
                }
            ],
            //'data_criacao:date',
            // 'tipo',
            // 'status',
            // 'user_id',
            // 'deletado:boolean',
            // 'identificador',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'text-right'],
            ],
        ],
    ]);
    ?>
</div>
