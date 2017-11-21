<?php

/**
 */

namespace api\versions\v1\controllers;

use api\versions\v1\models\Educador;
use api\versions\v1\models\Aluno;

class ServiceController extends \api\components\Controller {

    public function accessRules() {

        return [
            [
                'allow' => true,
                'actions' => [
                    'get-alunos',
                    'get-grupos',
                    'get-atividades',
                    'get-atividade'
                ],
                'verbs' => ['POST'],
                'roles' => ['?'],
            ],
        ];
    }

    /**
     * 
     * @return type
     */
    public function actionGetAlunos() {

        $post = \Yii::$app->request->post();
        $email = $post["email"];

        if (!isset($email)) {
            throw new \Exception('O email deve ser informado.');
        }
        $validator = new \yii\validators\EmailValidator();
        if (!$validator->validate($email)) {
            throw new \Exception('O email deve ser informado.');
        }
        return ['retorno' => Educador::getAlunos($email)];
    }

    /**
     * 
     * @return type
     */
    public function actionGetGrupos() {

        $post = \Yii::$app->request->post();
        $educadorId = $post["educador_id"];
        $alunoId = $post["aluno_id"];

        if (!isset($educadorId) || !isset($alunoId)) {
            throw new \Exception('Ops algo errado nos parâmetros');
        }

        return ['retorno' => Educador::getGruposDoAluno($educadorId, $alunoId)];
    }

    /**
     * 
     * @return type
     */
    public function actionGetAtividades() {

        $post = \Yii::$app->request->post();
        $alunoId = $post["aluno_id"];
        $grupoId = $post["grupo_id"];

        if (!isset($alunoId) || !isset($grupoId)) {
            throw new \Exception('Ops algo errado nos parâmetros');
        }
        
        return ['retorno' => Aluno::getAtividades($alunoId, $grupoId)];
    }
    
    /**
     * 
     * @return type
     */
    public function actionGetAtividade() {

        $post = \Yii::$app->request->post();
        $alunoId = $post["aluno_id"];
        $grupoId = $post["grupo_id"];
        $atividadeId = $post["atividade_id"];

        if (!isset($alunoId) || !isset($grupoId) || !isset($atividadeId)) {
            throw new \Exception('Ops algo errado nos parâmetros');
        }
        
        return ['retorno' => Aluno::getAtividade($alunoId, $grupoId, $atividadeId)];
    }

}
