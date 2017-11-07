<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\PlanoGrupo */

$this->title = Yii::t('translation', 'Update {modelClass}: ', [
    'modelClass' => 'Plano Grupo',
]) . ' ' . $model->plano_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Plano Grupo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->plano_id, 'url' => ['view', 'plano_id' => $model->plano_id, 'grupo_id' => $model->grupo_id]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'Update');
?>
<div class="plano-grupo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
