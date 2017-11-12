<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Educadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="educador-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
        <?= Html::a('Novo Educador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
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
            ],
        ],
    ]);
    ?>
</div>
