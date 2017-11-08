<?php

namespace app\modules\doman\controllers;

use Yii;
use app\modules\doman\models\Som;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SomController implements the CRUD actions for Som model.
 */
class SomController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Som models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Som::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Som model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerAtividade = new \yii\data\ArrayDataProvider([
            'allModels' => $model->atividades,
        ]);
        $providerCartaoSom = new \yii\data\ArrayDataProvider([
            'allModels' => $model->cartaoSoms,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerAtividade' => $providerAtividade,
            'providerCartaoSom' => $providerCartaoSom,
        ]);
    }

    /**
     * Creates a new Som model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Som();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Som model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Som model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the Som model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Som the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Som::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('translation', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Atividade
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddAtividade()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Atividade');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formAtividade', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('translation', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for CartaoSom
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddCartaoSom()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('CartaoSom');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formCartaoSom', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('translation', 'The requested page does not exist.'));
        }
    }
}
