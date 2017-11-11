<?php

namespace app\modules\doman\controllers;

use Yii;
use app\modules\doman\models\Cartao;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CartaoController implements the CRUD actions for Cartao model.
 */
class CartaoController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Displays a single Cartao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cartao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Cartao();
        $model->user_id = Yii::$app->user->id;
        $model->atividade_id = Yii::$app->request->get('atividade_id');

        if ($model->load(Yii::$app->request->post())) {

            $model->imagem = UploadedFile::getInstance($model, 'imagem');

            if ($model->upload()) {
                return $this->redirect(['/doman/atividade/view', 'id' => $model->atividade_id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cartao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->user_id = Yii::$app->user->id;
        $model->atividade_id = Yii::$app->request->get('atividade_id');

        if ($model->load(Yii::$app->request->post())) {

            $model->imagem = UploadedFile::getInstance($model, 'imagem');

            if ($model->upload()) {
                return $this->redirect(['/doman/atividade/view', 'id' => $model->atividade_id]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cartao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        $atividade_id = Yii::$app->request->get('atividade_id');

        return $this->redirect(['/doman/atividade/view', 'id' => $atividade_id]);
    }

    /**
     * Finds the Cartao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cartao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Cartao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
