<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\PlanoGrupo */

$this->title = Yii::t('translation', 'Create Plano Grupo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Plano Grupo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-grupo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
