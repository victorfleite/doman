<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace api\versions\v1\models;

/**
 * Description of HistoricoAtividadeAluno
 *
 * @author educatux
 */
class HistoricoAtividadeAluno extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'public.historico_atividade_aluno';
    }

    static function getHistoricoAtividadeAluno($educadorId, $alunoId, $grupoId, $atividadeId) {
        $sql = ' SELECT educador_id, educador_nome, aluno_id, aluno_nome, grupo_id, grupo_titulo, ' .
                ' TO_CHAR(data_insercao, \'DD/MM/YYYY HH24:MI\') as data_insercao ' .
                ' from vw_historico_atividade_aluno ' .
                ' where educador_id=:educadorId and aluno_id=:alunoId and ' .
                ' grupo_id=:grupoId and atividade_id=:atividadeId ' .
                ' order by data_insercao desc';
        $command = \Yii::$app->db->createCommand($sql);
        $command->bindValue(':educadorId', $educadorId);
        $command->bindValue(':alunoId', $alunoId);
        $command->bindValue(':grupoId', $grupoId);
        $command->bindValue(':atividadeId', $atividadeId);
        return $command->queryAll();
    }

}
