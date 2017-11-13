<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\doman\models;

use app\modules\doman\models\PlanoGrupo;

/**
 * Description of AssociarPlanoGrupoForm
 *
 * @author educatux
 */
class AssociarPlanoGrupoForm extends \yii\base\Model {

    public $plano_id;
    public $grupo_id;
    public $ordem;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['plano_id', 'grupo_id', 'ordem'], 'required'],
            [['plano_id', 'grupo_id'], 'safe'],
            [['grupo_id'], 'validarGrupo']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'plano_id' => 'Plano',
            'grupo_id' => 'Grupo',
        ];
    }

    public function validarGrupo($attribute, $params, $validator) {
        $exists = PlanoGrupo::find()->where(['plano_id' => $this->plano_id, 'grupo_id' => $this->grupo_id])->exists();
        if ($exists) {
            $plano = Plano::find($this->plano_id)->one();
            $this->addError('grupo_id', 'Grupo já associada ao Plano '. $plano->nome);
        }
    }

}
