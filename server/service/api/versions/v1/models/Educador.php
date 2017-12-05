<?php

namespace api\versions\v1\models;

/**
 */
class Educador extends \yii\db\ActiveRecord {

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const TIPO_RESPONSAVEL = 1;
    const TIPO_PROFESSOR = 2;
    const TIPO_ORIENTADOR_PEDAGOGICO = 3;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'educador';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    static function getEducador($email) {
        return Educador::find()->where(['email' => $email, 'status' => Educador::STATUS_ACTIVE, 'deletado' => false])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    static function getAlunos($educadorEmail) {
        $sql = 'SELECT ' .
                ' educador_id, aluno_id, aluno_nome, ' .
                ' TO_CHAR(aluno_data_nascimento, \'DD/MM/YYYY\') as aluno_data_nascimento, ' .
                ' aluno_tipo, aluno_sexo, aluno_imagem ' .
                ' FROM vw_educador_aluno ' .
                ' where educador_email=:educadorEmail ' .
                ' order by aluno_nome';

        $command = \Yii::$app->db->createCommand($sql);
        $command->bindValue(':educadorEmail', $educadorEmail);
        return $command->queryAll();
    }

    static function getGruposDoAluno($educadorId, $alunoId) {

        $sql = 'SELECT ' .
                ' grupo_id, grupo_titulo, ' .
                ' grupo_imagem, grupo_ordem, status' .
                ' FROM vw_educador_aluno_grupo ' .
                ' where educador_id=:educadorId and ' .
                ' aluno_id=:alunoId ' .
                ' order by grupo_ordem';

        $command = \Yii::$app->db->createCommand($sql);
        $command->bindValue(':educadorId', $educadorId);
        $command->bindValue(':alunoId', $alunoId);
        return $command->queryAll();
    }
    
    static function getGrupoDoAluno($alunoId, $grupoId) {

        $sql = 'SELECT ' .
                ' grupo_id, grupo_titulo, ' .
                ' grupo_imagem, grupo_ordem, status' .
                ' FROM vw_educador_aluno_grupo ' .
                ' where aluno_id=:alunoId and ' .
                ' grupo_id=:grupoId ';

        $command = \Yii::$app->db->createCommand($sql);        
        $command->bindValue(':alunoId', $alunoId);
        $command->bindValue(':grupoId', $grupoId);
        return $command->queryAll();
    }

}
