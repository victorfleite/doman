<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\doman\models;

use yii\helpers\ArrayHelper;
use app\modules\doman\models\Grupo;
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

    const SCENARIO_INSERT = 'insert';
    const SCENARIO_UPDATE = 'update';

    public function scenarios() {
        return [
            self::SCENARIO_INSERT => ['plano_id', 'grupo_id', 'ordem'],
            self::SCENARIO_UPDATE => ['ordem'],
        ];
    }

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
            $this->addError('grupo_id', 'Grupo já associada ao Plano ' . $plano->nome);
        }
    }

    public function getComboGrupos() {

        if ($this->scenario == AssociarPlanoGrupoForm::SCENARIO_UPDATE) {
            return ArrayHelper::map(Grupo::find()->where(['deletado' => false, 'status' => Grupo::STATUS_PUBLICADO])->orderBy('id')->asArray()->all(), 'id', 'titulo');
        } else {
            //INSERT
            $all = Grupo::find()->where(['deletado' => false, 'status' => Grupo::STATUS_PUBLICADO])->orderBy('id')->asArray()->all();
            $gruposExistentes = Plano::findOne($this->plano_id)->getGrupos()->asArray()->all();

            $diff = [];
            foreach ($all as $item) {
                $achei = false;
                foreach ($gruposExistentes as $existente) {
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
