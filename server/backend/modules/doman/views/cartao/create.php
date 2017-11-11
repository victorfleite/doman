<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Cartao */

$this->title = 'Novo Cartão';
$this->params['breadcrumbs'][] = ['label' => 'Atividades', 'url' => ['/doman/atividade/index']];
$this->params['breadcrumbs'][] = ['label' => $model->atividade->titulo, 'url' => ['/doman/atividade/view', 'id' => $model->atividade_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cartao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
