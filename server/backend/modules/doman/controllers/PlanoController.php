<?php

namespace app\modules\doman\controllers;

use Yii;
use app\modules\doman\models\Plano;
use \app\modules\doman\models\PlanoGrupo;
use app\modules\doman\models\AssociarPlanoGrupoForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlanoController implements the CRUD actions for Plano model.
 */
class PlanoController extends Controller {

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
     * Lists all Plano models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Plano::find(),
            'sort' => ['defaultOrder' => ['ordem' => SORT_ASC, 'id' => SORT_DESC]]
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Plano model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Plano model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Plano();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Plano model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Plano model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Plano model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Plano the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Plano::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function actionAssociarGrupo($id) {

        $model = new AssociarPlanoGrupoForm;
        $model->scenario = AssociarPlanoGrupoForm::SCENARIO_INSERT;
        $plano = $this->findModel($id);
        $model->plano_id = $id;
        $model->ordem = $plano->getGrupos()->count() + 1;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Salvar Relacional
            $planoGrupo = new PlanoGrupo;
            $planoGrupo->plano_id = $model->plano_id;
            $planoGrupo->grupo_id = $model->grupo_id;
            $planoGrupo->ordem = $model->ordem;
            $planoGrupo->save();

            return $this->redirect(['/doman/plano/view', 'id' => $plano->id]);
        }


        return $this->render('associar-grupo', [
                    'model' => $model,
                    'plano' => $plano,
        ]);
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function actionEditarAssociacaoGrupo($id) {

        $model = new AssociarPlanoGrupoForm;
        $model->scenario = AssociarPlanoGrupoForm::SCENARIO_UPDATE;
        $plano = $this->findModel($id);
        $model->plano_id = $id;
        $model->grupo_id = Yii::$app->request->get('grupo_id');
        $model->ordem = $plano->getGrupos()->count() + 1;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Salvar Relacional
            $planoGrupo = PlanoGrupo::find()->where(['plano_id' => $model->plano_id, 'grupo_id' => $model->grupo_id])->one();
            $planoGrupo->plano_id = $model->plano_id;
            $planoGrupo->grupo_id = $model->grupo_id;
            $planoGrupo->ordem = $model->ordem;
            $planoGrupo->save();

            return $this->redirect(['/doman/plano/view', 'id' => $plano->id]);
        }


        return $this->render('associar-grupo', [
                    'model' => $model,
                    'plano' => $plano,
        ]);
    }

    /**
     * 
     * @param type $grupoId
     * @return type
     */
    public function actionDeleteGrupo($id) {

        $grupoId = Yii::$app->request->get('grupo_id');
        \app\modules\doman\models\base\PlanoGrupo::deleteAll(['plano_id' => $id, 'grupo_id' => $grupoId]);

        return $this->redirect(['view', 'id' => $id]);
    }

}
