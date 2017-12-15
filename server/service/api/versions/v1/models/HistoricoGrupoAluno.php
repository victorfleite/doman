<?php

namespace api\versions\v1\models;

/**
 * This is the base model class for table "public.historico_grupo_aluno".
 *
 * @property integer $id
 * @property integer $grupo_id
 * @property integer $aluno_id
 * @property integer $educador_id
 * @property string $data_acesso
 */
class HistoricoGrupoAluno extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'public.historico_grupo_aluno';
    }

    static function getHistoricoGrupoAluno($educadorId, $alunoId) {
        $sql = ' SELECT educador_id, grupo_id,' .
                ' aluno_id, grupo_titulo, TO_CHAR(data_acesso, \'DD.MM.YYYY HH24:MI\') as data_acesso ' .
                ' from vw_historico_grupo_aluno' .
                ' where educador_id=:educadorId and aluno_id=:alunoId ' .
                ' order by data_acesso desc limit 1';
        $command = \Yii::$app->db->createCommand($sql);
        $command->bindValue(':educadorId', $educadorId);
        $command->bindValue(':alunoId', $alunoId);
        return $command->queryOne();
    }

}
