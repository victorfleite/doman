<?php

namespace common\components\behaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;
use app\modules\doman\models\Licenca;
use app\modules\doman\models\Plano;
use app\modules\doman\models\PlanoEducadorLicenca;

class LicencaFreePremiumBehavior extends Behavior {

    /**
     * 
     * @return type
     */
    public function events() {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'run',
        ];
    }

    public function run($event) {

        $licenca = new Licenca;
        $licenca->educador_id = $this->owner->id;
        $licenca->tipo = Licenca::TIPO_INFINITA;
        $licenca->save();

        // CRIAR LICENCA PLANO FREE
        $planoEducadorLicenca = new PlanoEducadorLicenca();
        $planoEducadorLicenca->plano_id = Plano::PLANO_FREE_ID;
        $planoEducadorLicenca->educador_id = $this->owner->id;
        $planoEducadorLicenca->licenca_id = $licenca->id;
        $planoEducadorLicenca->save();

        // CRIAR LICENCA PLANO PREMIUM
        $planoEducadorLicenca = new PlanoEducadorLicenca();
        $planoEducadorLicenca->plano_id = Plano::PLANO_PREMIUM_ID;
        $planoEducadorLicenca->educador_id = $this->owner->id;
        $planoEducadorLicenca->licenca_id = $licenca->id;
        $planoEducadorLicenca->save();
        
    }

}
