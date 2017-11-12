<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\doman\models;

use app\modules\doman\models\GrupoAtividade;

/**
 * Description of AssociarGrupoAtividadeForm
 *
 * @author educatux
 */
class AssociarGrupoAtividadeForm extends \yii\base\Model {

    public $grupo_id;
    public $atividade_id;
    public $ordem;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['grupo_id', 'atividade_id', 'ordem'], 'required'],
            [['grupo_id', 'atividade_id'], 'safe'],
            [['atividade_id'], 'validarAtividade']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'grupo_id' => 'Grupo',
            'atividade_id' => 'Atividade',
        ];
    }

    public function validarAtividade($attribute, $params, $validator) {
        $exists = GrupoAtividade::find()->where(['grupo_id' => $this->grupo_id, 'atividade_id' => $this->atividade_id])->exists();
        if ($exists) {
            $this->addError('atividade_id', 'Atividade já associada a este grupo');
        }
    }

}
