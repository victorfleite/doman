<?php

namespace app\modules\doman\controllers;

use Yii;
use app\modules\doman\models\Educador;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EducadorController implements the CRUD actions for Educador model.
 */
class EducadorController extends Controller
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
     * Lists all Educador models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Educador::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Educador model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerAtividadeAlunoNota = new \yii\data\ArrayDataProvider([
            'allModels' => $model->atividadeAlunoNotas,
        ]);
        $providerEducadorAluno = new \yii\data\ArrayDataProvider([
            'allModels' => $model->educadorAlunos,
        ]);
        $providerHistoricoAtividadeAluno = new \yii\data\ArrayDataProvider([
            'allModels' => $model->historicoAtividadeAlunos,
        ]);
        $providerLicenca = new \yii\data\ArrayDataProvider([
            'allModels' => $model->licencas,
        ]);
        $providerPlanoEducadorLicenca = new \yii\data\ArrayDataProvider([
            'allModels' => $model->planoEducadorLicencas,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerAtividadeAlunoNota' => $providerAtividadeAlunoNota,
            'providerEducadorAluno' => $providerEducadorAluno,
            'providerHistoricoAtividadeAluno' => $providerHistoricoAtividadeAluno,
            'providerLicenca' => $providerLicenca,
            'providerPlanoEducadorLicenca' => $providerPlanoEducadorLicenca,
        ]);
    }

    /**
     * Creates a new Educador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Educador();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
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
     * Deletes an existing Educador model.
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
     * Finds the Educador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Educador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Educador::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('translation', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for AtividadeAlunoNota
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddAtividadeAlunoNota()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('AtividadeAlunoNota');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formAtividadeAlunoNota', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('translation', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for EducadorAluno
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddEducadorAluno()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('EducadorAluno');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formEducadorAluno', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('translation', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for HistoricoAtividadeAluno
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddHistoricoAtividadeAluno()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('HistoricoAtividadeAluno');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formHistoricoAtividadeAluno', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('translation', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Licenca
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddLicenca()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Licenca');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formLicenca', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('translation', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for PlanoEducadorLicenca
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddPlanoEducadorLicenca()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('PlanoEducadorLicenca');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formPlanoEducadorLicenca', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('translation', 'The requested page does not exist.'));
        }
    }
}
