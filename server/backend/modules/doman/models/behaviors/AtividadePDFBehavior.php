<?php

namespace app\modules\doman\models\behaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;

use \app\modules\doman\models\Cartao;
use \app\modules\doman\models\Atividade;


/**
 * Este behavior é responsável por executar uma store procedure que 
 * cria grupos e atividades novas aos alunos já existentes normalizando as atividades
 */
class AtividadePDFBehavior extends Behavior {

    public $whoCall;
    
    /**
     * 
     * @return type
     */
    public function events() {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'run',
            ActiveRecord::EVENT_AFTER_UPDATE => 'run',
            ActiveRecord::EVENT_AFTER_DELETE => 'run',
        ];
    }

    public function run($event) {

        if ($this->owner instanceof Cartao) {
             $atividade = $this->owner->atividade;
        }
        
        if ($this->owner instanceof Atividade) {             
             $atividade = $this->owner;
        }
        
        if ($atividade->tipo == Atividade::TIPO_BIT_INTELIGENCIA) {
           $atividade->savePdf();           
        }
    }

}
