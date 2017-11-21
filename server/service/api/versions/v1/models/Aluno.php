<?php

namespace api\versions\v1\models;

/**
 */
class Aluno extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'aluno';
    }

    static function getAtividades($alunoId, $grupoId) {

        $sql = 'SELECT ' .
                ' atividade_id, atividade_titulo, ' .
                ' atividade_tipo, data_finalizacao, ordem' .
                ' FROM vw_atividade_aluno ' .
                ' where aluno_id=:alunoId and ' .
                ' grupo_id=:grupoId ' .
                ' order by ordem';

        $command = \Yii::$app->db->createCommand($sql);
        $command->bindValue(':alunoId', $alunoId);
        $command->bindValue(':grupoId', $grupoId);
        return $command->queryAll();
    }

    static function getAtividade($alunoId, $grupoId, $atividadeId) {

        $sql = 'SELECT titulo, status, data_publicacao, data_criacao,'.
               ' tipo, video_url, autoplay, som_id, descricao, imagem ' .
               ' FROM atividade ' .
               ' where id=:atividadeId and deletado=false and status=2';
        $command = \Yii::$app->db->createCommand($sql);
        $command->bindValue(':atividadeId', $atividadeId);
        return $command->queryAll();
    }

}
