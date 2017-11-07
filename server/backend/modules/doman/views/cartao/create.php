<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Cartao */

$this->title = Yii::t('translation', 'Create Cartao');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Cartao'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cartao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
