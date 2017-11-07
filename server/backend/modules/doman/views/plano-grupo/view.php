<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\PlanoGrupo */

$this->title = $model->plano_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Plano Grupo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-grupo-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('translation', 'Plano Grupo').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a(Yii::t('translation', 'Update'), ['update', 'plano_id' => $model->plano_id, 'grupo_id' => $model->grupo_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('translation', 'Delete'), ['delete', 'plano_id' => $model->plano_id, 'grupo_id' => $model->grupo_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('translation', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        [
            'attribute' => 'plano.id',
            'label' => Yii::t('translation', 'Plano'),
        ],
        [
            'attribute' => 'grupo.id',
            'label' => Yii::t('translation', 'Grupo'),
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>