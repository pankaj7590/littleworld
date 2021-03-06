<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use common\models\Setting;

$this->title = $name;

//contact page options
$contactPageOptionModels = Setting::find()->where(['setting_group' => Setting::GROUP_CONTACT_PAGE])->all();
$contactPageOptions = [];
foreach($contactPageOptionModels as $contactPageOptionModel){
	$contactPageOptions[$contactPageOptionModel->name] = $contactPageOptionModel;
}

$contact_map_address = $contactPageOptions['contact_map_address']['value'];
$contact_phone = $contactPageOptions['contact_phone']['value'];
$contact_email = $contactPageOptions['contact_email']['value'];
?>
<div class="grid_4 bot-1">
	<h2 class="top-6">Contact Us</h2>
	<div class="map">
		<iframe src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?= ($contact_map_address?$contact_map_address:'Brooklyn,+New+York,+NY,+United+States');?>&amp;aq=0&amp;sll=37.0625,-95.677068&amp;sspn=61.282355,146.513672&amp;ie=UTF8&amp;hq=&amp;hnear=Brooklyn,+Kings,+New+York&amp;ll=40.649974,-73.950005&amp;spn=0.01628,0.025663&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
	</div>
	<dl>
		<dt><?= ($contact_map_address?$contact_map_address:'');?></dt>
		<dd><span>Telephone: </span><?= ($contact_phone?$contact_phone:'');?></dd>
		<dd><span>E-mail: </span><a href="mailto:<?= ($contact_email?$contact_email:'');?>" class="link"><?= ($contact_email?$contact_email:'');?></a></dd>
	</dl>
</div>
<div class="grid_8">
	<div class="block-1 top-5">
		<div class="block-1-shadow">
			<h2 class="clr-6"><?= Html::encode($this->title) ?></h2>
			<div class="site-error">
				<div class="alert alert-danger">
					<?= nl2br(Html::encode($message)) ?>
				</div>
				<p>
					The above error occurred while the Web server was processing your request.
				</p>
				<p>
					Please contact us if you think this is a server error. Thank you.
				</p>
			</div>
		</div>
	</div>
</div>
<?php
$this->registerCss("
	.block-1-shadow {
		padding: 18px 30px 29px 30px;
	}
");
?>