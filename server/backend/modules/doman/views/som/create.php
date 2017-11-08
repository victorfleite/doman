<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Som */

$this->title = Yii::t('translation', 'Create Som');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Som'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="som-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
