<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use backend\models\Menu;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
        <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css" type="text/css" />
	<?php $this->head() ?>
    </head>
    <body>
	<?php $this->beginBody() ?>

	<div class="wrap">
	    <?php
	    NavBar::begin([
		'brandLabel' => Yii::$app->id,
		'brandUrl' => Yii::$app->homeUrl,
		'options' => [
		    'class' => 'navbar-inverse navbar-fixed-top',
		],
	    ]);

	   
	    echo Nav::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		'items' => Menu::getItens(),
	    ]);
	    NavBar::end();
	    ?>

	    <div class="container">
		<?=
		Breadcrumbs::widget([
		    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		])
		?>
		<?= Alert::widget() ?>
		<?= $content ?>
	    </div>
	</div>

	<footer class="footer">
	    <div class="container">
		<p class="pull-left">&copy; Valle de Filadelfia / <?= date('Y') ?></p>

	    </div>
	</footer>

	<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
