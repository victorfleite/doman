<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Plano */

$this->title = Yii::t('translation', 'Create Plano');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Plano'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
