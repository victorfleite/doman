<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Licenca */

$this->title = $model->identificador;
$this->params['breadcrumbs'][] = ['label' => 'Licencas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->identificador, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="licenca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
