<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\doman\models\AtividadeAluno */

$this->title = Yii::t('translation', 'Create Atividade Aluno');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Atividade Aluno'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atividade-aluno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
