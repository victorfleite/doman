<?php

namespace common\components\behaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;
/**
 * Este behavior é responsável por executar uma store procedure que 
 * cria grupos e atividades novas aos alunos já existentes normalizando as atividades
 */
class NormalizadorBehavior extends Behavior {

    /**
     * 
     * @return type
     */
    public function events() {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'run',
            ActiveRecord::EVENT_AFTER_UPDATE => 'run',
        ];
    }

    public function run($event) {

        try {
            $sql = "select normalizador()";
            $command = \Yii::$app->db->createCommand($sql);
            $out = $command->queryAll();
            //\Yii::$app->dumper->debug($command->queryAll(), true);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

}
