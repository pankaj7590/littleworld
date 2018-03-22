<?php
/**
 * navigation-left.php
 *
 * @author Pedro Plowman
 * @copyright Copyright &copy; Pedro Plowman, 2017
 * @link https://github.com/p2made
 * @package p2made/yii2-sb-admin-theme
 * @license MIT
 */

use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use common\models\Contact;
use common\models\NewsEvent;

use p2m\widgets\MetisNav;
use p2m\helpers\FA;

$arrowIcon = FA::i('arrow')->tag('span');
?>
<section class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav bg-dark" id="side-menu">
			<li><?= Html::a(
				FA::fw('dashboard') . ' Dashboard',
				Yii::$app->homeUrl
			) ?></li><!-- Dashboard -->
			<li>
				<a href="#"><?= FA::fw('users') ?> Staff<?= $arrowIcon ?></a>
				<?= MetisNav::widget([
					'encodeLabels' => false,
					'options' => ['class' => 'nav nav-second-level'],
					'items' => [
						['label' => 'Add Staff', 'url' => ['/user/create']],
						['label' => 'Manage Staff', 'url' => ['/user/index']],
					],
				]) ?>
			</li>
			<li>
				<a href="#"><?= FA::fw('user-circle') ?> Students<?= $arrowIcon ?></a>
				<?= MetisNav::widget([
					'encodeLabels' => false,
					'options' => ['class' => 'nav nav-second-level'],
					'items' => [
						['label' => 'New Student', 'url' => ['/student/create']],
						['label' => 'Manage Students', 'url' => ['/student/index']],
					],
				]) ?>
			</li>
			<li>
				<a href="#"><?= FA::fw('book') ?> Subjects<?= $arrowIcon ?></a>
				<?= MetisNav::widget([
					'encodeLabels' => false,
					'options' => ['class' => 'nav nav-second-level'],
					'items' => [
						['label' => 'New Subjects', 'url' => ['/subject/create']],
						['label' => 'Manage Subjects', 'url' => ['/subject/index']],
					],
				]) ?>
			</li>
			<li>
				<a href="#"><?= FA::fw('folder-open') ?> Admissions<?= $arrowIcon ?></a>
				<?= MetisNav::widget([
					'encodeLabels' => false,
					'options' => ['class' => 'nav nav-second-level'],
					'items' => [
						['label' => 'New Admission', 'url' => ['/admission/create']],
						['label' => 'Manage Admissions', 'url' => ['/admission/index']],
					],
				]) ?>
			</li>
			<li>
				<a href="#"><?= FA::fw('sort-alpha-asc') ?> Divisions<?= $arrowIcon ?></a>
				<?= MetisNav::widget([
					'encodeLabels' => false,
					'options' => ['class' => 'nav nav-second-level'],
					'items' => [
						['label' => 'Add Division', 'url' => ['/division/create']],
						['label' => 'Manage Divisions', 'url' => ['/division/index']],
					],
				]) ?>
			</li>
			<li>
				<a href="#"><?= FA::fw('tasks') ?> Examinations<?= $arrowIcon ?></a>
				<?= MetisNav::widget([
					'encodeLabels' => false,
					'options' => ['class' => 'nav nav-second-level'],
					'items' => [
						['label' => 'New Examination', 'url' => ['/exam/create']],
						['label' => 'Manage Examinations', 'url' => ['/exam/index']],
					],
				]) ?>
			</li>
			<li>
				<a href="#"><?= FA::fw('money') ?> Fees<?= $arrowIcon ?></a>
				<?= MetisNav::widget([
					'encodeLabels' => false,
					'options' => ['class' => 'nav nav-second-level'],
					'items' => [
						['label' => 'Add Fee', 'url' => ['/fee/create']],
						['label' => 'Manage Fees', 'url' => ['/fee/index']],
					],
				]) ?>
			</li>
			<li>
				<a href="#"><?= FA::fw('table') ?> Galleries<?= $arrowIcon ?></a>
				<?= MetisNav::widget([
					'encodeLabels' => false,
					'options' => ['class' => 'nav nav-second-level'],
					'items' => [
						['label' => 'New Gallery', 'url' => ['/gallery/create']],
						['label' => 'Manage Galleries', 'url' => ['/gallery/index']],
					],
				]) ?>
			</li>
			<li>
				<a href="#"><?= FA::fw('image') ?> Media<?= $arrowIcon ?></a>
				<?= MetisNav::widget([
					'encodeLabels' => false,
					'options' => ['class' => 'nav nav-second-level'],
					'items' => [
						['label' => 'New Media', 'url' => ['/media/create']],
						['label' => 'Manage Media', 'url' => ['/media/index']],
					],
				]) ?>
			</li>
			<li>
				<a href="#"><?= FA::fw('calendar') ?> News & Events<?= $arrowIcon ?></a>
				<?= MetisNav::widget([
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
				<a href="#"><?= FA::fw('credit-card') ?> Payments<?= $arrowIcon ?></a>
				<?= MetisNav::widget([
					'encodeLabels' => false,
					'options' => ['class' => 'nav nav-second-level'],
					'items' => [
						['label' => 'Manage Payments', 'url' => ['/payment/index']],
					],
				]) ?>
			</li>
			<li>
				<a href="#"><?= FA::fw('sliders') ?> Settings<?= $arrowIcon ?></a>
				<?= MetisNav::widget([
					'encodeLabels' => false,
					'options' => ['class' => 'nav nav-second-level'],
					'items' => [
						['label' => 'New Setting', 'url' => ['/setting/create']],
						['label' => 'Manage Settings', 'url' => ['/setting/index']],
					],
				]) ?>
			</li>
			<li>
				<a href="#"><?= FA::fw('envelope-square') ?> Communications<?= $arrowIcon ?></a>
				<?= MetisNav::widget([
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
</section>