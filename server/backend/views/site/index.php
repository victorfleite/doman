<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
$this->params['breadcrumbs'][] = '';
//$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php
                                    echo \app\modules\doman\models\Educador::find()->where(['deletado' => false])->count();
                                    ?>
                                </div>
                                <div>Educadores</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo Url::to(['/doman/educador/index']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Acessar Educadores</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-graduation-cap fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php
                                    echo \app\modules\doman\models\Aluno::find()->where(['deletado' => false])->count();
                                    ?>
                                </div>
                                <div>Alunos</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo Url::to(['/doman/aluno/index']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Acessar Alunos</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-id-card-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php
                                    echo \app\modules\doman\models\Licenca::find()->where(['deletado' => false])->count();
                                    ?>
                                </div>
                                <div>Licenças</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo Url::to(['/doman/licenca/index']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Acessar Licenças</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user-circle-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php
                                    echo \app\modules\doman\models\User::find()->count();
                                    ?>
                                </div>
                                <div>Usuários</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo Url::to(['/user']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Acessar Usuários do Sistema</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>            
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-object-group fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php
                                    echo \app\modules\doman\models\Grupo::find()->where(['deletado' => false])->count();
                                    ?>                                    
                                </div>
                                <div>Grupos</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo Url::to(['/doman/grupo/index']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Acessar Grupos</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>           
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-music fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php
                                    echo \app\modules\doman\models\Som::find()->count();
                                    ?>
                                </div>
                                <div>Sons</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo Url::to(['/doman/som/index']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Acessar Sons</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-certificate fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php
                                    echo \app\modules\doman\models\Plano::find()->where(['deletado' => false])->count();
                                    ?>
                                </div>
                                <div>Planos</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo Url::to(['/doman/plano/index']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Acessar Planos</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-cogs fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">                                   
                                </div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo Url::to(['/admin']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Controle de Acesso</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>       

        </div>
        <div class="row">            
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-picture-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"> 
                                    <?php
                                    echo \app\modules\doman\models\Atividade::find()->where(['deletado' => false])->count();
                                    ?>
                                </div>
                                <div>Atividades</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo Url::to(['/doman/atividade/index']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Acessar Atividades</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-bar-chart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">                                    
                                </div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo Url::to(['/doman/relatorio/index']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Acessar Relatórios</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-rocket fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">                                    
                                </div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <a href="./js/fabric-js-editor/build/index.html" target="_blank">
                        <div class="panel-footer">
                            <span class="pull-left">Editor de Cartão</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
