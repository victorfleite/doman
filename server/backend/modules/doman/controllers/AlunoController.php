<?php

namespace app\modules\doman\controllers;

use Yii;
use app\modules\doman\models\Aluno;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \app\modules\doman\models\AssociarAlunoEducadorForm;
use \app\modules\doman\models\EducadorAluno;

/**
 * AlunoController implements the CRUD actions for Aluno model.
 */
class AlunoController extends Controller {

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
     * Lists all Aluno models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Aluno::find()->where(['deletado' => false]),
            'sort' => ['defaultOrder' => ['nome' => SORT_ASC, 'data_nascimento' => SORT_DESC]]
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aluno model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Aluno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Aluno();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Aluno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Aluno model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Aluno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aluno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Aluno::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAssociarEducador($id) {

        $model = new AssociarAlunoEducadorForm;
        $aluno = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $educadores = $model->educadores;
            // Delete todos os alunos encontrados
            EducadorAluno::deleteAll('aluno_id = :aluno_id', [':aluno_id' => $aluno->id]);
            // Criando todos os educadores novamente
            if (is_array($educadores)) {
                foreach ($educadores as $id) {
                    $rl = new EducadorAluno();
                    $rl->educador_id = $id;
                    $rl->aluno_id = $aluno->id;
                    $rl->save();
                }
            }
            return $this->redirect(['/doman/aluno/view', 'id' => $aluno->id]);
        }
        $model->educadores = $aluno->getTodosIdsEducadores();
        return $this->render('associar-educador', [
                    'model' => $model,
                    'aluno' => $aluno,
        ]);
    }

}
