<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Atividade */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Atividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->titulo, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="atividade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
