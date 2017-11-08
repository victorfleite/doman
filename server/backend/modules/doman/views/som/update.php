<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Som */

$this->title = Yii::t('translation', 'Update {modelClass}: ', [
    'modelClass' => 'Som',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Som'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'Update');
?>
<div class="som-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
