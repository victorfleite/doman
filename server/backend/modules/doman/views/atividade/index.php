<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \app\modules\doman\models\Atividade;
use \app\modules\doman\models\Cartao;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atividades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atividade-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
        <?= Html::a('Nova Atividade', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
            //'data_publicacao',
            //'data_criacao',
            // 'user_id',
            // 'user_publicacao_id',
            // 'deletado:boolean',
            // 'tipo',
            // 'video_url:url',
            // 'autoplay:boolean',
            // 'som_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'text-right'],
            ],
        ],
    ]);
    ?>
</div>
