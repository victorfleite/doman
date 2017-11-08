<div class="form-group" id="add-atividade-aluno">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

if(empty($row)){
    $row[] = [];
}


$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'AtividadeAluno',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
        'atividade_id' => [
            'label' => 'Atividade',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\modules\doman\models\Atividade::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => Yii::t('translation', 'Choose Atividade')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'aluno_id' => [
            'label' => 'Grupo aluno',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\modules\doman\models\GrupoAluno::find()->orderBy('grupo_id')->asArray()->all(), 'aluno_id', 'grupo_id'),
                'options' => ['placeholder' => Yii::t('translation', 'Choose Grupo aluno')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'status' => ['type' => TabularForm::INPUT_TEXT],
        'atividade_pai' => [
            'label' => 'Atividade aluno',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\modules\doman\models\AtividadeAluno::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => Yii::t('translation', 'Choose Atividade aluno')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'data_criacao' => ['type' => TabularForm::INPUT_TEXT],
        'data_abertura' => ['type' => TabularForm::INPUT_TEXT],
        'data_finalizacao' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('translation', 'Delete'), 'onClick' => 'delRowAtividadeAluno(' . $key . '); return false;', 'id' => 'atividade-aluno-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('translation', 'Add Atividade Aluno'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowAtividadeAluno()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

