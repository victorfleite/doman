<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\doman\models;

use \yii\helpers\ArrayHelper;
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

    const SCENARIO_INSERT = 'insert';
    const SCENARIO_UPDATE = 'update';

    public function scenarios() {
        return [
            self::SCENARIO_INSERT => ['grupo_id', 'atividade_id', 'ordem'],
            self::SCENARIO_UPDATE => ['ordem'],
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['grupo_id', 'atividade_id', 'ordem'], 'required', 'on' => self::SCENARIO_INSERT],
            [['grupo_id', 'atividade_id', 'ordem'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['atividade_id'], 'validarAtividade', 'on' => self::SCENARIO_INSERT]
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

    public function getComboAtividade() {

        if ($this->scenario == AssociarGrupoAtividadeForm::SCENARIO_UPDATE) {
            return ArrayHelper::map(Atividade::find()->where(['deletado' => false, 'status' => Atividade::STATUS_PUBLICADO])->orderBy('id')->asArray()->all(), 'id', 'titulo');
        } else {
            //INSERT
            $all = Atividade::find()->where(['deletado' => false, 'status' => Atividade::STATUS_PUBLICADO])->orderBy('id')->asArray()->all();
            $atividadeExistentes = Grupo::findOne($this->grupo_id)->getAtividades()->asArray()->all();

            $diff = [];
            foreach ($all as $item) {
                $achei = false;
                foreach ($atividadeExistentes as $existente) {
                    if ($existente['id'] == $item['id']) {
                        $achei = true;
                        break;
                    }
                }
                if (!$achei) {
                    $diff[] = $item;
                }
            }
            return ArrayHelper::map($diff, 'id', 'titulo');
        }
    }

}
