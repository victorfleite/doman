<div class="form-group" id="add-cartao-som">
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
    'formName' => 'CartaoSom',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        'cartao_id' => [
            'label' => 'Cartao',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\modules\doman\models\Cartao::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => Yii::t('translation', 'Choose Cartao')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('translation', 'Delete'), 'onClick' => 'delRowCartaoSom(' . $key . '); return false;', 'id' => 'cartao-som-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('translation', 'Add Cartao Som'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowCartaoSom()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

