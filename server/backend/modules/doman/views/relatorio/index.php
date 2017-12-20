<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => 'Relatórios', 'url' => ['relatorio/index']];
$this->params['breadcrumbs'][] = '';

//$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">
   
        <div class="row">            
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-area-chart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                               
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo Url::to(['/doman/atividade/index']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Relatório de Acesso às Atividades</span>
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
                            <span class="pull-left">Relatório de Desempenho</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
