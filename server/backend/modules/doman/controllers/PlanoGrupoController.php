<?php

namespace app\modules\doman\controllers;

use Yii;
use app\modules\doman\models\PlanoGrupo;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlanoGrupoController implements the CRUD actions for PlanoGrupo model.
 */
class PlanoGrupoController extends Controller
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
     * Lists all PlanoGrupo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PlanoGrupo::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlanoGrupo model.
     * @param integer $plano_id
     * @param integer $grupo_id
     * @return mixed
     */
    public function actionView($plano_id, $grupo_id)
    {
        $model = $this->findModel($plano_id, $grupo_id);
        return $this->render('view', [
            'model' => $this->findModel($plano_id, $grupo_id),
        ]);
    }

    /**
     * Creates a new PlanoGrupo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PlanoGrupo();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'plano_id' => $model->plano_id, 'grupo_id' => $model->grupo_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PlanoGrupo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $plano_id
     * @param integer $grupo_id
     * @return mixed
     */
    public function actionUpdate($plano_id, $grupo_id)
    {
        $model = $this->findModel($plano_id, $grupo_id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'plano_id' => $model->plano_id, 'grupo_id' => $model->grupo_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PlanoGrupo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $plano_id
     * @param integer $grupo_id
     * @return mixed
     */
    public function actionDelete($plano_id, $grupo_id)
    {
        $this->findModel($plano_id, $grupo_id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the PlanoGrupo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $plano_id
     * @param integer $grupo_id
     * @return PlanoGrupo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($plano_id, $grupo_id)
    {
        if (($model = PlanoGrupo::findOne(['plano_id' => $plano_id, 'grupo_id' => $grupo_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('translation', 'The requested page does not exist.'));
        }
    }
}
