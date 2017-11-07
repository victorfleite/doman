<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Licenca */

$this->title = Yii::t('translation', 'Create Licenca');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Licenca'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="licenca-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
