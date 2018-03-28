<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\web\View;

AppAsset::register($this);

$user = Yii::$app->user;
$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
		<?php if(Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'gallery'){
			$this->registerCssFile($baseUrl.'/css/demo.css');
		}else{
			$this->registerCssFile($baseUrl.'/css/demo.css');
		}?>
		<link href='http://fonts.googleapis.com/css?family=Cabin+Sketch:400,700' rel='stylesheet' type='text/css'>
		<!--[if lt IE 9]>
		<script src="js/html5.js"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
		<![endif]-->
	</head>
	<body>
		<?php $this->beginBody() ?>
			<div class="main">
			  <!--==============================header=================================-->
			  <header>
				<h1><a href="<?= $urlManager->createAbsoluteUrl(['site/index']);?>"><img src="<?= $baseUrl;?>/images/logo.png" alt=""></a></h1>
				<nav>
				  <div id="slide">
					<?php if(Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'gallery'){?>
						<div class="gallery">
						  <ul class="items">
							<li><img src="<?= $baseUrl?>/images/gallery-big-1.jpg" alt=""></li>
							<li><img src="<?= $baseUrl?>/images/gallery-big-2.jpg" alt=""></li>
							<li><img src="<?= $baseUrl?>/images/gallery-big-3.jpg" alt=""></li>
							<li><img src="<?= $baseUrl?>/images/gallery-big-4.jpg" alt=""></li>
							<li><img src="<?= $baseUrl?>/images/gallery-big-5.jpg" alt=""></li>
							<li><img src="<?= $baseUrl?>/images/gallery-big-6.jpg" alt=""></li>
							<li><img src="<?= $baseUrl?>/images/gallery-big-7.jpg" alt=""></li>
							<li><img src="<?= $baseUrl?>/images/gallery-big-8.jpg" alt=""></li>
						  </ul>
						</div>
					<?php }else{?>
						<div class="slider">
						  <ul class="items">
							<li><img src="<?= $baseUrl?>/images/slider-1.jpg" alt=""></li>
							<li><img src="<?= $baseUrl?>/images/slider-2.jpg" alt=""></li>
							<li><img src="<?= $baseUrl?>/images/slider-3.jpg" alt=""></li>
						  </ul>
						</div>
					<?php }?>
					<a href="#" class="prev"></a><a href="#" class="next"></a> </div>
				  <ul class="menu">
					<li class="current"><a href="<?= $urlManager->createAbsoluteUrl(['site/index']);?>" class="clr-1">Home</a></li>
					<li><a href="<?= $urlManager->createAbsoluteUrl(['site/about']);?>" class="clr-2">About</a></li>
					<li><a href="<?= $urlManager->createAbsoluteUrl(['site/schedule']);?>" class="clr-3">Schedule</a></li>
					<li><a href="<?= $urlManager->createAbsoluteUrl(['site/gallery']);?>" class="clr-4">Gallery</a></li>
					<li><a href="<?= $urlManager->createAbsoluteUrl(['site/contact']);?>" class="clr-5">Contact</a></li>
					<?php if(Yii::$app->user->isGuest){?>
						<li><a href="<?= $urlManager->createAbsoluteUrl(['site/login']);?>" class="clr-2">Login</a></li>
						<li><a href="<?= $urlManager->createAbsoluteUrl(['site/signup']);?>" class="clr-4">Register</a></li>
					<?php }else{?>
						<li><a href="<?= $urlManager->createAbsoluteUrl(['student/index']);?>" class="clr-2">My Child</a></li>
						<li><a href="<?= $urlManager->createAbsoluteUrl(['site/logout']);?>" data-method="post" class="clr-4">Logout</a></li>
					<?php }?>
				  </ul>
				</nav>
			  </header>
			  <!--==============================content================================-->
			  <section id="content">
				<div class="container_12">
					<?php
						$alertTypes = [
							'error'   => 'alert-danger',
							'danger'  => 'alert-danger',
							'success' => 'alert-success',
							'info'    => 'alert-info',
							'warning' => 'alert-warning'
						];
						$session = Yii::$app->session;
						$flashes = $session->getAllFlashes();

						foreach ($flashes as $type => $flash) {
							if (!isset($alertTypes[$type])) {
								continue;
							}

							foreach ((array) $flash as $i => $message) {
								echo '<div class="'.$alertTypes[$type].' alert fade in">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										'.$message.'
									</div>';
							}
							$session->removeFlash($type);
						}
					?>
					<?= $content;?>
				  <div class="clear"></div>
				</div>
			  </section>
			</div>
		<?php $this->endBody() ?>
		<?php
			$this->registerJs("				
				$('.slider')._TMS({
					show: 0,
					pauseOnHover: true,
					prevBu: '.prev',
					nextBu: '.next',
					playBu: false,
					duration: 800,
					preset: 'fade',
					pagination: true,
					pagNums: false,
					slideshow: 7000,
					numStatus: false,
					banners: false,
					waitBannerAnimation: false,
					progressBar: false
				});
				$('.alert button.close').on('click', function(){
					$(this).parents('.alert').remove();
				});
			", View::POS_LOAD, "init-slider");
		?>
	</body>
</html>
<?php $this->endPage() ?>