<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Grupo */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="grupo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
