<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'Alunos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
        <?= Html::a('Novo Aluno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'imagem',
                'format' => 'raw',
                'contentOptions' => [],
                'value' => function($data) {
                    return Html::a(Html::img($data->imagem, ['width' => 80, 'height' => 80]), Url::to(['view', 'id' => $data->id]), $options = []);
                },
            ],
            'nome',
            'data_nascimento:date',
            [
                'attribute' => 'sexo',
                'value' => function($data) {
                    return app\modules\doman\models\Aluno::getSexoLabel($data->sexo);
                }
            ],
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
            //'user_id',
            // 'data_criacao',
            // 'deletado:boolean',
            // 'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'text-right'],
            ],
        ],
    ]);
    ?>
</div>
