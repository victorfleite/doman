<div class="form-group" id="add-plano-educador-licenca">
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
    'formName' => 'PlanoEducadorLicenca',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        'plano_id' => [
            'label' => 'Plano',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\modules\doman\models\Plano::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => Yii::t('translation', 'Choose Plano')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'licenca_id' => [
            'label' => 'Licenca',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\modules\doman\models\Licenca::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => Yii::t('translation', 'Choose Licenca')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('translation', 'Delete'), 'onClick' => 'delRowPlanoEducadorLicenca(' . $key . '); return false;', 'id' => 'plano-educador-licenca-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('translation', 'Add Plano Educador Licenca'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowPlanoEducadorLicenca()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

