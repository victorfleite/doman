<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Grupo */

$this->title = 'Novo Grupo';
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
