<?php

namespace api\versions\v1\models;

/**
 */
class Atividade extends \yii\db\ActiveRecord {

    const TIPO_BIT_INTELIGENCIA = 1; // Bits de Inteligência
    const TIPO_MIDIA_YOUTUBE = 2; // Mídia Youtube
    const TIPO_MIDIA_SOM = 3; // Midia MP3

    /**
     * @inheritdoc
     */

    public static function tableName() {
        return 'atividade';
    }

    static function getAtividades($alunoId, $grupoId) {

        $sql = ' SELECT id, aluno_id, nome, grupo_id,' .
                ' grupo_titulo, atividade_id, atividade_titulo,' .
                ' atividade_tipo, video_url, autoplay, som_id, som_titulo,' .
                ' som_caminho, atividade_descricao, atividade_instrucao, atividade_imagem, ' .
                ' atividade_status, TO_CHAR(data_criacao, \'DD/MM/YYYY HH24:MI\') as data_criacao, ' .
                ' TO_CHAR(data_abertura, \'DD/MM/YYYY HH24:MI\') as data_abertura, ' .
                ' TO_CHAR(data_finalizacao, \'DD/MM/YYYY HH24:MI\') as data_finalizacao ,pdf, ordem ' .
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
        

         $sql = ' SELECT id, aluno_id, nome, grupo_id,' .
                ' grupo_titulo, atividade_id, atividade_titulo,' .
                ' atividade_tipo, video_url, autoplay, som_id, som_titulo,' .
                ' som_caminho, atividade_descricao, atividade_instrucao, atividade_imagem, ' .
                ' atividade_status, TO_CHAR(data_criacao, \'DD/MM/YYYY HH24:MI\') as data_criacao, ' .
                ' TO_CHAR(data_abertura, \'DD/MM/YYYY HH24:MI\') as data_abertura, ' .
                ' TO_CHAR(data_finalizacao, \'DD/MM/YYYY HH24:MI\') as data_finalizacao ,pdf, ordem ' .
                ' FROM vw_atividade_aluno ' .
                ' where aluno_id=:alunoId and ' .
                ' grupo_id=:grupoId and '.
                ' atividade_id=:atividadeId ';
         
        $command = \Yii::$app->db->createCommand($sql);
        $command->bindValue(':alunoId', $alunoId);
        $command->bindValue(':grupoId', $grupoId);
        $command->bindValue(':atividadeId', $atividadeId);
        return $command->queryAll();
    }

    static function getCartoesAluno($alunoId, $grupoId, $atividadeId) {

        $sql = ' SELECT cartao_aluno_id, cartao_id, cartao_nome, ' .
                ' cartao_ordem, TO_CHAR(cartao_datacriacao, \'DD/MM/YYYY HH24:MI\') as cartao_datacriacao, ' .
                ' imagem_caminho, status_convocacao, conhecido, data_conhecimento, ' .
                ' som_id, som_titulo, som_caminho ' .
                ' FROM vw_cartao_aluno' .
                ' where aluno_id=:alunoId and grupo_id=:grupoId and atividade_id=:atividadeId';

        $command = \Yii::$app->db->createCommand($sql);
        $command->bindValue(':alunoId', $alunoId);
        $command->bindValue(':grupoId', $grupoId);
        $command->bindValue(':atividadeId', $atividadeId);
        return $command->queryAll();
    }

}
