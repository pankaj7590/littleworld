<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);

$dropDownOptions = ['class' => 'dropdown-menu dropdown-messages'];
$dropDownCaret = '<i class="fa fa-caret-down fa-fw"></i>';
$arrowIcon = '<span class="fa arrow"></span>';
$userMenu = array(
	'label' => '<i class="fa fa-user fa-fw"></i>',
	'dropDownOptions' => $dropDownOptions,
	'dropDownCaret' => $dropDownCaret,
	'url' => '#',
	'items' => [
		['url' => ['/site/profile'], 'label' => '<i class="fa fa-user fa-fw"></i>' . ' User Profile', 'encode' => false],
		['url' => ['/setting/index'], 'label' => '<i class="fa fa-gear fa-fw"></i>' . ' Settings', 'encode' => false],
		'<li class="divider"></li>',
		//['url' => '#', 'label' => FA::i('sign-out')->fixedWidth() . ' Logout', 'encode' => false],
	],
);
if (Yii::$app->user->isGuest) {
	$userMenu['items'][] = [
		//'label' => 'Signup', 'url' => ['/site/signup'],
		'label' => 'Login', 'url' => '#', // ['/site/login']
	];
} else {
	$userMenu['items'][] = [
		'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
		'url' => ['/site/logout'],
		'linkOptions' => ['data-method' => 'post']
	];
}
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
	</head>
	<body>
		<?php $this->beginBody() ?>
			<div id="wrapper">
				<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<?= Html::a('<b>Little World</b> Admin', Yii::$app->homeUrl, ['class' => 'navbar-brand']) ?>
					</div>

					<?php
					echo Nav::widget([
						'options' => ['class' => 'nav navbar-top-links navbar-right'],
						'items' => [
							// $messagesMenu, // dropdown-messages
							// $tasksMenu, // dropdown-tasks
							// $alertsMenu, // dropdown-alerts
							$userMenu, // dropdown-user
						],
						'encodeLabels' => false,
					]);
					?>
					<div class="navbar-default sidebar" role="navigation">
						<div class="sidebar-nav navbar-collapse">
							<ul class="nav in" id="side-menu">
								<li><?= Html::a(
									'<i class="fa fa-dashboard fa-fw"></i> Dashboard',
									Yii::$app->homeUrl
								) ?></li><!-- Dashboard -->
								<li>
									<a href="#"><i class="fa fa-users fa-fw"></i> Staff<?= $arrowIcon ?></a>
									<?= Nav::widget([
										'activateParents' => true,
										'encodeLabels' => false,
										'options' => ['class' => 'nav nav-second-level'],
										'items' => [
											['label' => 'Add Staff', 'url' => ['/user/create']],
											['label' => 'Manage Staff', 'url' => ['/user/index']],
										],
									]) ?>
								</li>
								<li>
									<a href="#"><i class="fa fa-user fa-fw"></i> Guardians<?= $arrowIcon ?></a>
									<?= Nav::widget([
										'activateParents' => true,
										'encodeLabels' => false,
										'options' => ['class' => 'nav nav-second-level'],
										'items' => [
											['label' => 'Manage Guardians', 'url' => ['/guardian/index']],
										],
									]) ?>
								</li>
								<li>
									<a href="#"><i class="fa fa-user fa-fw"></i> Students<?= $arrowIcon ?></a>
									<?= Nav::widget([
										'activateParents' => true,
										'encodeLabels' => false,
										'options' => ['class' => 'nav nav-second-level'],
										'items' => [
											['label' => 'New Student', 'url' => ['/student/create']],
											['label' => 'Manage Students', 'url' => ['/student/index']],
										],
									]) ?>
								</li>
								<li>
									<a href="#"><i class="fa fa-book fa-fw"></i> Subjects<?= $arrowIcon ?></a>
									<?= Nav::widget([
										'activateParents' => true,
										'encodeLabels' => false,
										'options' => ['class' => 'nav nav-second-level'],
										'items' => [
											['label' => 'New Subjects', 'url' => ['/subject/create']],
											['label' => 'Manage Subjects', 'url' => ['/subject/index']],
										],
									]) ?>
								</li>
								<li>
									<a href="#"><i class="fa fa-folder-open fa-fw"></i> Admissions<?= $arrowIcon ?></a>
									<?= Nav::widget([
										'activateParents' => true,
										'encodeLabels' => false,
										'options' => ['class' => 'nav nav-second-level'],
										'items' => [
											['label' => 'New Admission', 'url' => ['/admission/check-guardian']],
											['label' => 'Manage Admissions', 'url' => ['/admission/index']],
										],
									]) ?>
								</li>
								<li>
									<a href="#"><i class="fa fa-sort-alpha-asc fa-fw"></i> Divisions<?= $arrowIcon ?></a>
									<?= Nav::widget([
										'activateParents' => true,
										'encodeLabels' => false,
										'options' => ['class' => 'nav nav-second-level'],
										'items' => [
											['label' => 'Add Division', 'url' => ['/division/create']],
											['label' => 'Manage Divisions', 'url' => ['/division/index']],
										],
									]) ?>
								</li>
								<li>
									<a href="#"><i class="fa fa-tasks fa-fw"></i> Examinations<?= $arrowIcon ?></a>
									<?= Nav::widget([
										'activateParents' => true,
										'encodeLabels' => false,
										'options' => ['class' => 'nav nav-second-level'],
										'items' => [
											['label' => 'New Examination', 'url' => ['/exam/create']],
											['label' => 'Manage Examinations', 'url' => ['/exam/index']],
										],
									]) ?>
								</li>
								<li>
									<a href="#"><i class="fa fa-money fa-fw"></i> Fees<?= $arrowIcon ?></a>
									<?= Nav::widget([
										'activateParents' => true,
										'encodeLabels' => false,
										'options' => ['class' => 'nav nav-second-level'],
										'items' => [
											['label' => 'Add Fee', 'url' => ['/fee/create']],
											['label' => 'Manage Fees', 'url' => ['/fee/index']],
										],
									]) ?>
								</li>
								<li>
									<a href="#"><i class="fa fa-table fa-fw"></i> Galleries<?= $arrowIcon ?></a>
									<?= Nav::widget([
										'activateParents' => true,
										'encodeLabels' => false,
										'options' => ['class' => 'nav nav-second-level'],
										'items' => [
											['label' => 'New Gallery', 'url' => ['/gallery/create']],
											['label' => 'Manage Galleries', 'url' => ['/gallery/index']],
										],
									]) ?>
								</li>
								<li>
									<a href="#"><i class="fa fa-image fa-fw"></i> Media<?= $arrowIcon ?></a>
									<?= Nav::widget([
										'activateParents' => true,
										'encodeLabels' => false,
										'options' => ['class' => 'nav nav-second-level'],
										'items' => [
											['label' => 'Manage Media', 'url' => ['/media/index']],
										],
									]) ?>
								</li>
								<li>
									<a href="#"><i class="fa fa-calendar fa-fw"></i> News & Events<?= $arrowIcon ?></a>
									<?= Nav::widget([
										'activateParents' => true,
										'encodeLabels' => false,
										'options' => ['class' => 'nav nav-second-level'],
										'items' => [
											['label' => 'New News', 'url' => ['/news-event/create']],
											['label' => 'Manage News', 'url' => ['/news-event/index']],
											['label' => 'New Event', 'url' => ['/news-event/event-create']],
											['label' => 'Manage Events', 'url' => ['/news-event/event-index']],
										],
									]) ?>
								</li>
								<li>
									<a href="#"><i class="fa fa-credit-card fa-fw"></i> Payments<?= $arrowIcon ?></a>
									<?= Nav::widget([
										'activateParents' => true,
										'encodeLabels' => false,
										'options' => ['class' => 'nav nav-second-level'],
										'items' => [
											['label' => 'Manage Payments', 'url' => ['/payment/index']],
										],
									]) ?>
								</li>
								<li>
									<a href="#"><i class="fa fa-sliders fa-fw"></i> Settings<?= $arrowIcon ?></a>
									<?= Nav::widget([
										'activateParents' => true,
										'encodeLabels' => false,
										'options' => ['class' => 'nav nav-second-level'],
										'items' => [
											['label' => 'Theme Options', 'url' => ['/setting/theme-options']],
											['label' => 'New Setting', 'url' => ['/setting/create']],
											['label' => 'Manage Settings', 'url' => ['/setting/index']],
										],
									]) ?>
								</li>
								<li>
									<a href="#"><i class="fa fa-envelope-square fa-fw"></i> Communications<?= $arrowIcon ?></a>
									<?= Nav::widget([
										'activateParents' => true,
										'encodeLabels' => false,
										'options' => ['class' => 'nav nav-second-level'],
										'items' => [
											['label' => 'Manage Contacts', 'url' => ['/contact/index']],
											['label' => 'Manage Feedbacks', 'url' => ['/contact/feedback']],
											['label' => 'Manage Inquiries', 'url' => ['/contact/inquiry']],
										],
									]) ?>
								</li>
							</ul>
						</div>
					</div>
				</nav>
				<div id="page-wrapper">
					<div class="container-fluid">

						<header class="row">
							<div class="col-lg-12">
								<h1 class="page-header"><?php echo $this->title; ?></h1>
								<?= Breadcrumbs::widget([
									'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
								]) ?>
								<?= Alert::widget() ?>
							</div>
						</header>

						<?= $content ?>

					</div>

				</div>
			</div>
		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>