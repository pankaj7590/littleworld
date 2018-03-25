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
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<?= $content;?>
					</div>
				</div>
			</div>
		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>