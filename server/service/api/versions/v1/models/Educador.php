<?php

namespace api\versions\v1\models;

/**
 */
class Educador extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'educador';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    static function getAlunos($educadorEmail) {
        $sql = 'SELECT '.
               ' aluno_nome, aluno_data_nascimento, '.
               ' aluno_tipo, aluno_sexo, aluno_imagem '.
               ' FROM vw_educador_aluno '.
               ' where educador_email=:educadorEmail '.
               ' order by aluno_nome';
        
        $command = \Yii::$app->db->createCommand($sql);        
        $command->bindValue(':educadorEmail', $educadorEmail);
        return $command->queryAll();
    }
    
    static function getGruposDoAluno($educadorId, $alunoId){
        
        $sql = 'SELECT '.
               ' grupo_id, grupo_titulo, '.
               ' grupo_imagem, grupo_ordem, status'.
               ' FROM vw_educador_aluno_grupo '.
               ' where educador_id=:educadorId and '.
               ' aluno_id=:alunoId '.
               ' order by grupo_ordem';
        
        $command = \Yii::$app->db->createCommand($sql);        
        $command->bindValue(':educadorId', $educadorId);
        $command->bindValue(':alunoId', $alunoId);
        return $command->queryAll();        
    }

}
