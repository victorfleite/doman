<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \app\modules\doman\models\Atividade;
use \app\modules\doman\models\Cartao;
use yii\helpers\Url;

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
            [
                'attribute' => 'imagem',
                'format' => 'raw',
                'contentOptions' => [],
                'value' => function($data) {
                    return Html::a(Html::img($data->imagem, ['width' => 80, 'height' => 45]), Url::to(['view', 'id' => $data->id]), $options = []);
                },
            ],
             [
                'attribute' => 'titulo',
                'format'=>'raw',
                'value' => function($data) {
                    $titulo = $data->titulo;
                    if ($data->tipo == Atividade::TIPO_MIDIA_SOM) {                    
                        $audio =  '<br><audio controls>';
                        $audio .= '     <source src="'. $data->som->caminho .'" type="audio/mpeg">';
                        $audio .= '     Your browser does not support the audio element.';
                        $audio .= '</audio>';
                        $titulo .= $audio;
                    }
                    if ($data->tipo == Atividade::TIPO_MIDIA_YOUTUBE) {                    
                        $audio =  '<br><a href="'. $data->video_url .'" target="_blank">'.$data->video_url.'</a>';
                        $titulo .= $audio;
                    }
                    return $titulo;
                }
            ],
                        
                       
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
