<?php

namespace app\modules\doman\controllers;

use Yii;
use app\modules\doman\models\Atividade;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AtividadeController implements the CRUD actions for Atividade model.
 */
class AtividadeController extends Controller
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
     * Lists all Atividade models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Atividade::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Atividade model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerAtividadeAluno = new \yii\data\ArrayDataProvider([
            'allModels' => $model->atividadeAlunos,
        ]);
        $providerCartao = new \yii\data\ArrayDataProvider([
            'allModels' => $model->cartaos,
        ]);
        $providerGrupoAtividade = new \yii\data\ArrayDataProvider([
            'allModels' => $model->grupoAtividades,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerAtividadeAluno' => $providerAtividadeAluno,
            'providerCartao' => $providerCartao,
            'providerGrupoAtividade' => $providerGrupoAtividade,
        ]);
    }

    /**
     * Creates a new Atividade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Atividade();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Atividade model.
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
     * Deletes an existing Atividade model.
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
     * Finds the Atividade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Atividade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Atividade::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('translation', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for AtividadeAluno
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddAtividadeAluno()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('AtividadeAluno');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formAtividadeAluno', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('translation', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Cartao
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddCartao()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Cartao');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formCartao', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('translation', 'The requested page does not exist.'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for GrupoAtividade
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddGrupoAtividade()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('GrupoAtividade');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formGrupoAtividade', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('translation', 'The requested page does not exist.'));
        }
    }
}
