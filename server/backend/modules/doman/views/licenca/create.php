<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Licenca */

$this->title = 'Create Licenca';
$this->params['breadcrumbs'][] = ['label' => 'Licencas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="licenca-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
