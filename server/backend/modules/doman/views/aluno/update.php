<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Aluno */

$this->title = Yii::t('translation', 'Update {modelClass}: ', [
    'modelClass' => 'Aluno',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Aluno'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'Update');
?>
<div class="aluno-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
