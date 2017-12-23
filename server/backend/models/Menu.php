<?php

namespace backend\models;

use yii\helpers\Html;
use Yii;

/**
 * Signup form
 */
class Menu {

    /**
     * @inheritdoc
     */
    static public function getItens() {


        $languageMenu = ['label' => Yii::t('translation', 'menu.language'), 'items' => [
                ['label' => Yii::t('translation', 'menu.language.english'), 'url' => ['site/set-language', 'language' => 'en']],
                ['label' => Yii::t('translation', 'menu.language.portuguese'), 'url' => ['site/set-language', 'language' => 'pt-BR']],
        ]];
        if (Yii::$app->user->isGuest) {
            //$menuItems[] = $languageMenu;
            $menuItems[] = ['label' => Yii::t('translation', 'menu.login'), 'url' => ['/site/login']];
        } else {
            $menuItems[] = ['label' => Yii::t('translation', 'menu.home'), 'url' => ['/site/index']];

            $aplicacaoMenu = ['label' => "Aplicação", 'items' => [
                    ['label' => "Educadores", 'url' => ['/doman/educador/index']],
                    ['label' => "Alunos", 'url' => ['/doman/aluno/index']],
                    ['label' => "Grupos", 'url' => ['/doman/grupo/index']],
                    ['label' => "Atividades", 'url' => ['/doman/atividade/index']],
                    ['label' => "Sons", 'url' => ['/doman/som/index']],
                    ['label' => "Planos", 'url' => ['/doman/plano/index']],
                    ['label' => "Licenças", 'url' => ['/doman/licenca/index']],
                    '<li class="divider"></li>',
                    ['label' => "Editor de Cartão", 'url' => "./js/fabric-js-editor/build/index.html", 'linkOptions' => ['target' => '_blank']],
                    ['label' => "Gravador de Som", 'url' => './js/audiorecorder/index.html', 'linkOptions' => ['target' => '_blank']],
            ]];
            $menuItems[] = $aplicacaoMenu;

            //$menuItems[] = $languageMenu;
            if (Yii::$app->user->can('/admin/*')) {

                $userRegister = ['label' => Yii::t('translation', 'menu.user_register'), 'url' => ['/user/index']];
                $userAdministration = ['label' => Yii::t('translation', 'menu.access_control'), 'url' => ['/admin']];

                $menuItems[] = ['label' => Yii::t('translation', 'menu.administration'), 'items' => [
                        $userRegister,
                        $userAdministration],
                ];
            }
            $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                            Yii::t('translation', 'menu.logout') . ' (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>';
        };

        return $menuItems;
    }

}
