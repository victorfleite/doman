<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Educador */

$this->title = 'Novo Educador';
$this->params['breadcrumbs'][] = ['label' => 'Educadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="educador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
