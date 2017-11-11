<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\doman\models;

/**
 * Description of AssociarAlunoEducadorForm
 *
 * @author educatux
 */
class AssociarAlunoEducadorForm extends \yii\base\Model {

    public $alunos;
    public $educadores;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            ['alunos', 'safe'],
            ['educadores', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'alunos' => 'Alunos',
            'educadores' => 'Educadores',
        ];
    }

}
