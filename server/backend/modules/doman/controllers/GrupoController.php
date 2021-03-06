<?php

namespace app\modules\doman\controllers;

use Yii;
use app\modules\doman\models\Grupo;
use app\modules\doman\models\GrupoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\modules\doman\models\AssociarGrupoAtividadeForm;
use \app\modules\doman\models\GrupoAtividade;

/**
 * GrupoController implements the CRUD actions for Grupo model.
 */
class GrupoController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'delete-atividade' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Grupo models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new GrupoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Grupo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Grupo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Grupo();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post())) {

            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->upload()) {
                return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing Grupo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post())) {

            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->upload()) {
                return $this->redirect(['view', 'id' => $model->id]);
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
     * Deletes an existing Grupo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Grupo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Grupo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Grupo::findOne($id)) !== null) {
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
    public function actionAssociarAtividade($id) {

        $model = new AssociarGrupoAtividadeForm;
        $model->scenario = AssociarGrupoAtividadeForm::SCENARIO_INSERT;
        $grupo = $this->findModel($id);
        $model->grupo_id = $id;
        $model->ordem = $grupo->getAtividades()->count() + 1;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Salvar Relacional
            $grupoAtidade = new GrupoAtividade;
            $grupoAtidade->grupo_id = $model->grupo_id;
            $grupoAtidade->atividade_id = $model->atividade_id;
            $grupoAtidade->ordem = $model->ordem;
            $grupoAtidade->save();

            return $this->redirect(['/doman/grupo/view', 'id' => $grupo->id]);
        }


        return $this->render('associar-atividade', [
                    'model' => $model,
                    'grupo' => $grupo,
        ]);
    }
    /**
     * 
     * @param type $id
     * @return type
     */
    public function actionEditarAssociacaoAtividade($id) {

        $model = new AssociarGrupoAtividadeForm;
        $model->scenario = AssociarGrupoAtividadeForm::SCENARIO_UPDATE;
        $grupo = $this->findModel($id);
        $model->grupo_id = $id;
        $model->atividade_id = Yii::$app->request->get('atividade_id');
        $model->ordem = Yii::$app->request->get('ordem');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Atualizar Relacional
            $grupoAtidade = GrupoAtividade::find()->where(['grupo_id' => $model->grupo_id, 'atividade_id' => $model->atividade_id])->one();
            $grupoAtidade->grupo_id = $model->grupo_id;
            $grupoAtidade->atividade_id = $model->atividade_id;
            $grupoAtidade->ordem = $model->ordem;
            $grupoAtidade->save();

            return $this->redirect(['/doman/grupo/view', 'id' => $grupo->id]);
        }


        return $this->render('associar-atividade', [
                    'model' => $model,
                    'grupo' => $grupo
        ]);
    }
    /**
     * 
     * @param type $grupoId
     * @return type
     */
    public function actionDeleteAtividade($id) {

        $atividadeId = Yii::$app->request->get('atividade_id');
        \app\modules\doman\models\base\GrupoAtividade::deleteAll(['grupo_id' => $id, 'atividade_id' => $atividadeId]);

        return $this->redirect(['view', 'id'=>$id]);
    }

}
