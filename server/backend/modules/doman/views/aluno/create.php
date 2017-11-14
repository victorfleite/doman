<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\Aluno */

$this->title = Yii::t('translation', 'Novo Aluno');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Alunos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
