<?php

namespace app\modules\doman\controllers;

use Yii;
use app\modules\doman\models\Educador;
use app\modules\doman\models\EducadorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \app\modules\doman\models\AssociarAlunoEducadorForm;
use \app\modules\doman\models\EducadorAluno;
use \common\components\behaviors\LicencaFreePremiumBehavior;

/**
 * EducadorController implements the CRUD actions for Educador model.
 */
class EducadorController extends Controller {

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
     * Lists all Educador models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EducadorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Educador model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Educador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Educador();
        $model->user_id = Yii::$app->user->id;
        
        $model->attachBehavior('LicencaFreePremiumBehavior', LicencaFreePremiumBehavior::className());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Educador model.
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
     * Deletes an existing Educador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Educador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Educador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Educador::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAssociarAluno($id) {

        $model = new AssociarAlunoEducadorForm;
        $educador = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $alunos = $model->alunos;
            // Delete todos os alunos encontrados
            EducadorAluno::deleteAll('educador_id = :educador_id', [':educador_id' => $educador->id]);
            // Criando todos os alunos novamente
            if (is_array($alunos)) {
                foreach ($alunos as $id) {
                    $rl = new EducadorAluno();
                    $rl->aluno_id = $id;
                    $rl->educador_id = $educador->id;
                    $rl->save();
                }
            }
            return $this->redirect(['/doman/educador/view', 'id' => $educador->id]);
        }
        $model->alunos = $educador->getTodosIdsAlunos();
        return $this->render('associar-aluno', [
                    'model' => $model,
                    'educador' => $educador,
        ]);
    }

}
