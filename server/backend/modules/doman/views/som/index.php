<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="som-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    

    <p class="text-right">
        <?= Html::a('Novo Som', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'titulo',
                'format'=>'raw',
                'value' => function($data) {
                    $titulo = $data->titulo;
                                   
                        $audio =  '<br><audio controls>';
                        $audio .= '     <source src="'. $data->caminho .'" type="audio/mpeg">';
                        $audio .= '     Your browser does not support the audio element.';
                        $audio .= '</audio>';
                        $titulo .= $audio;
                   
                    return $titulo;
                }
            ],
            [
                'attribute' => 'caminho',
                'format' => 'raw',
                'value' => function($data) {
		    return Html::a($data->caminho, $data->caminho, $options = ['target' => '_blank']);
		},
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
