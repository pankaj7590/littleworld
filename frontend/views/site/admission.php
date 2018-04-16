<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Setting;


/* @var $this yii\web\View */
/* @var $model common\models\Admission */

$this->title = 'Request Admission';
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
<div class="grid_5 bot-1">
	<h2 class="top-6">Request Admission</h2>
	<div class="map">
		<iframe src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?= ($contact_map_address?$contact_map_address:'Brooklyn,+New+York,+NY,+United+States');?>&amp;aq=0&amp;sll=37.0625,-95.677068&amp;sspn=61.282355,146.513672&amp;ie=UTF8&amp;hq=&amp;hnear=Brooklyn,+Kings,+New+York&amp;ll=40.649974,-73.950005&amp;spn=0.01628,0.025663&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
	</div>
	<dl>
		<dt><?= ($contact_map_address?$contact_map_address:'');?></dt>
		<dd><span>Telephone: </span><?= ($contact_phone?$contact_phone:'');?></dd>
		<dd><span>E-mail: </span><a href="mailto:<?= ($contact_email?$contact_email:'');?>" class="link"><?= ($contact_email?$contact_email:'');?></a></dd>
	</dl>
</div>
<div class="grid_7">
	<div class="block-1 top-5">
		<div class="block-1-shadow">
				<?php $form = ActiveForm::begin(['id' => 'form']); ?>
							<h2 class="clr-6">Student Information</h2>
							<fieldset>
								<?= $this->render('_admission_student_form', [
									'model' => $studentModel,
									'form' => $form,
								]) ?>
							</fieldset>
							<h2 class="clr-6">Guardian Information</h2>
							<fieldset>
								<?= $this->render('_admission_guardian_form', [
									'model' => $guardianModel,
									'form' => $form,
								]) ?>
								<div class="btns pad-2">
									<?= Html::resetButton('Reset', ['class' => 'link-2', 'id' => 'contact-reset-btn', 'name' => 'contact-button']) ?>
									<?= Html::submitButton('Request', ['class' => 'link-2', 'id' => 'contact-submit-btn',  'name' => 'contact-button']) ?>
								</div>
							</fieldset>
				<?php ActiveForm::end(); ?>
		</div>
	</div>
	<?= $this->render('../layouts/_footer.php')?>
</div>