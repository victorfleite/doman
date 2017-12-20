<?php

/**
 */

namespace api\versions\v1\controllers;

use api\versions\v1\models\Educador;
use api\versions\v1\models\Atividade;
use api\versions\v1\models\GrupoAluno;
use api\versions\v1\models\HistoricoGrupoAluno;
use api\versions\v1\models\HistoricoAtividadeAluno;
use api\versions\v1\models\CartaoAluno;

class ServiceController extends \api\components\Controller {

    const ACTIVITY_CONVOCACAO = 'convocacao';
    const ACTIVITY_CONHECIMENTO = 'conhecimento';

    public function accessRules() {

        return [
            [
                'allow' => true,
                'actions' => [
                    'get-educador',
                    'get-alunos',
                    'get-grupos',
                    'get-grupo',
                    'get-atividades',
                    'get-atividade',
                    'set-status-grupos-aluno',
                    'set-historico-atividade-aluno',
                    'get-last-access-grupo-aluno',
                    'get-historico-atividade-aluno',
                    'set-status-cartao-aluno'
                ],
                'verbs' => ['POST'],
                'roles' => ['?'],
            ],
        ];
    }

    /**
     * 
     * @return type
     * @throws \Exception
     */
    public function actionGetEducador() {

        $post = \Yii::$app->request->post();
        $email = $post["email"];

        if (!isset($email)) {
            throw new \Exception('O email deve ser informado.');
        }
        $validator = new \yii\validators\EmailValidator();
        if (!$validator->validate($email)) {
            throw new \Exception('O email deve ser informado.');
        }
        return ['retorno' => Educador::getEducador($email)];
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
    public function actionGetGrupo() {

        $post = \Yii::$app->request->post();
        $educadorId = $post["educador_id"];
        $alunoId = $post["aluno_id"];
        $grupoId = $post["grupo_id"];


        if (!isset($educadorId) || !isset($grupoId) || !isset($alunoId)) {
            throw new \Exception('Ops algo errado nos parâmetros');
        }

        $historicoGrupoAluno = new HistoricoGrupoAluno();
        $historicoGrupoAluno->educador_id = $educadorId;
        $historicoGrupoAluno->aluno_id = $alunoId;
        $historicoGrupoAluno->grupo_id = $grupoId;
        $historicoGrupoAluno->save();

        return ['retorno' => Educador::getGrupoDoAluno($alunoId, $grupoId)[0]];
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

        $atividades = Atividade::getAtividades($alunoId, $grupoId);
        $out = [];
        foreach ($atividades as $atividade) {
            if ($atividade['atividade_tipo'] == Atividade::TIPO_BIT_INTELIGENCIA) {
                $atividade['cartoes'] = Atividade::getCartoesAluno($alunoId, $grupoId, $atividade['atividade_id']);
            }
            $out[] = $atividade;
        }
        return ['retorno' => $out];
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
        $atividade = Atividade::getAtividade($alunoId, $grupoId, $atividadeId)[0];

        if (isset($atividade) && $atividade['atividade_tipo'] == Atividade::TIPO_BIT_INTELIGENCIA) {
            $atividade['cartoes'] = Atividade::getCartoesAluno($alunoId, $grupoId, $atividadeId);
        }
        return ['retorno' => $atividade];
    }

    /**
     * 
     */
    public function actionSetStatusGruposAluno() {

        $post = \Yii::$app->request->post();
        $educadorId = $post["educador_id"];
        $alunoId = $post["aluno_id"];
        $grupos = $post["grupos"];

        if (!isset($educadorId) || !isset($alunoId)) {
            throw new \Exception('Ops algo errado nos parâmetros');
        }

        $educador = Educador::findOne($educadorId);

        if ($educador->tipo == Educador::TIPO_ORIENTADOR_PEDAGOGICO ||
                $educador->tipo == Educador::TIPO_PROFESSOR
        ) {

            foreach ($grupos as $grupo) {

                $grupoAluno = GrupoAluno::find()->where(['aluno_id' => $alunoId, 'grupo_id' => $grupo['grupo_id']])->one();
                $grupoAluno->status = $grupo['status'];
                $grupoAluno->save();
            }
        }
        return ['retorno' => 'atualizado!'];
    }

    public function actionSetHistoricoAtividadeAluno() {

        $post = \Yii::$app->request->post();
        $educadorId = $post["educador_id"];
        $alunoId = $post["aluno_id"];
        $grupoId = $post["grupo_id"];
        $atividadeId = $post["atividade_id"];

        if (!isset($educadorId) || !isset($alunoId) || !isset($grupoId) || !isset($atividadeId)) {
            throw new \Exception('Ops algo errado nos parâmetros');
        }
        $historico = new HistoricoAtividadeAluno();
        $historico->educador_id = $educadorId;
        $historico->aluno_id = $alunoId;
        $historico->grupo_id = $grupoId;
        $historico->atividade_id = $atividadeId;
        $historico->browser = $_SERVER["HTTP_USER_AGENT"];
        $historico->save();

        return ['retorno' => 'atualizado!'];
    }

    public function actionGetLastAccessGrupoAluno() {

        $post = \Yii::$app->request->post();
        $educadorId = $post["educador_id"];
        $alunoId = $post["aluno_id"];

        if (!isset($educadorId) || !isset($alunoId)) {
            throw new \Exception('Ops algo errado nos parâmetros');
        }

        $lastAccess = HistoricoGrupoAluno::getHistoricoGrupoAluno($educadorId, $alunoId);

        return ['retorno' => $lastAccess];
    }

    public function actionGetHistoricoAtividadeAluno() {

        $post = \Yii::$app->request->post();
        $educadorId = $post["educador_id"];
        $alunoId = $post["aluno_id"];
        $grupoId = $post["grupo_id"];
        $atividadeId = $post["atividade_id"];

        if (!isset($educadorId) || !isset($alunoId) || !isset($grupoId) || !isset($atividadeId)) {
            throw new \Exception('Ops algo errado nos parâmetros');
        }

        $lastAccess = HistoricoAtividadeAluno::getHistoricoAtividadeAluno($educadorId, $alunoId, $grupoId, $atividadeId);

        return ['retorno' => $lastAccess];
    }

    /**
     * 
     */
    public function actionSetStatusCartaoAluno() {

        $post = \Yii::$app->request->post();

        $cartaoAlunoId = $post["cartao_aluno_id"];
        $activity = $post["activity"];
        $statusConvocacao = $post["status_convocacao"];
        $conhecido = $post["conhecido"];
        
        if (!isset($cartaoAlunoId) || !isset($activity)) {
            throw new \Exception('Ops algo errado nos parâmetros');
        }
        $cartaoAluno = CartaoAluno::findOne($cartaoAlunoId);

        if (!isset($cartaoAluno)) {
            throw new \Exception('Cartao not founded.');
        }


        if ($cartaoAluno->status_convocacao != $statusConvocacao) {

            $cartaoTransacao = new \api\versions\v1\models\CartaoTransacaoLog();
            $cartaoTransacao->cartao_aluno_id = $cartaoAluno->id;
            $cartaoTransacao->transacao_status = $statusConvocacao;
            $cartaoTransacao->save();
        }

        if ($activity == self::ACTIVITY_CONVOCACAO) {

            if (!isset($cartaoAluno->data_entrada) && $statusConvocacao) {
                $cartaoAluno->data_entrada = date("Y-m-d H:i:s");
            }
            if (!$statusConvocacao) {
                $cartaoAluno->data_saida = date("Y-m-d H:i:s");
            }
            $cartaoAluno->status_convocacao = $statusConvocacao;
            $cartaoAluno->save();
        }

        if ($activity == self::ACTIVITY_CONHECIMENTO) {

            if (!$conhecido) {
                $cartaoAluno->data_conhecimento = null;
            } else {
                $cartaoAluno->data_conhecimento = date("Y-m-d H:i:s");
            }
            $cartaoAluno->conhecido = $conhecido;
            $cartaoAluno->save();
        }

        return ['retorno' => $cartaoAluno];
    }

}
