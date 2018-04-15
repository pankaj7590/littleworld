<?php
use common\models\Setting;
use yii\web\View;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$user = Yii::$app->user;
$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;

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
			<h2 class="clr-6">Contact Form</h2>
			<?php $form = ActiveForm::begin(['id' => 'form']); ?>
				<fieldset>
					<?= $form->field($model, 'name', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['autofocus' => true]) ?>
					<strong class="clear"></strong>
					<?= $form->field($model, 'email', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}']) ?>
					<strong class="clear"></strong>
					<?= $form->field($model, 'subject', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}']) ?>
					<strong class="clear"></strong>
					<?= $form->field($model, 'body', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textarea(['rows' => 6]) ?>
					<strong class="clear"></strong>
					<?= $form->field($model, 'verifyCode', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->widget(Captcha::className(), []) ?>
					<strong class="clear"></strong>
					<div class="btns pad-2">
						<?= Html::resetButton('Reset', ['class' => 'link-2', 'id' => 'contact-reset-btn', 'name' => 'contact-button']) ?>
						<?= Html::submitButton('Submit', ['class' => 'link-2', 'id' => 'contact-submit-btn',  'name' => 'contact-button']) ?>
					</div>
				</fieldset>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
	<?= $this->render('../layouts/_footer.php')?>
</div>