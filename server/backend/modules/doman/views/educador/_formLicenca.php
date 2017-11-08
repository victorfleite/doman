<div class="form-group" id="add-licenca">
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
    'formName' => 'Licenca',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'data_inicio' => ['type' => TabularForm::INPUT_TEXT],
        'data_fim' => ['type' => TabularForm::INPUT_TEXT],
        'data_criacao' => ['type' => TabularForm::INPUT_TEXT],
        'tipo' => ['type' => TabularForm::INPUT_TEXT],
        'status' => ['type' => TabularForm::INPUT_TEXT],
        'user_id' => [
            'label' => 'User',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\modules\doman\models\User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
                'options' => ['placeholder' => Yii::t('translation', 'Choose User')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'deletado' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'identificador' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('translation', 'Delete'), 'onClick' => 'delRowLicenca(' . $key . '); return false;', 'id' => 'licenca-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('translation', 'Add Licenca'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowLicenca()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

