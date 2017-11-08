<div class="form-group" id="add-atividade">
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
    'formName' => 'Atividade',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'titulo' => ['type' => TabularForm::INPUT_TEXT],
        'status' => ['type' => TabularForm::INPUT_TEXT],
        'data_publicacao' => ['type' => TabularForm::INPUT_TEXT],
        'data_criacao' => ['type' => TabularForm::INPUT_TEXT],
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
        'user_publicacao_id' => [
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
        'tipo' => ['type' => TabularForm::INPUT_TEXT],
        'video_url' => ['type' => TabularForm::INPUT_TEXT],
        'autoplay' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('translation', 'Delete'), 'onClick' => 'delRowAtividade(' . $key . '); return false;', 'id' => 'atividade-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('translation', 'Add Atividade'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowAtividade()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

