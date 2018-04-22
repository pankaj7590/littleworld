<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>
	<?= $form->field($model, 'photoPictureFile', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->fileInput() ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'name', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['maxlength' => true]) ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'address', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textarea(['rows' => 6]) ?>
	<strong class="clear"></strong>
	<div class="form-group">
		<label class="control-label">
			<strong><label class="control-label" for="copy-student-address"></label></strong>
			<button type="button" id="copy-guardian-address" class="btn btn-default btn-xs">Copy guardian address</button>
		</label>
	</div>
	<strong class="clear"></strong>
    <?= $form->field($model, 'dob', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['type' => 'date', 'max' => date('Y-m-d', (time()-(2*365*24*3600)))]); ?>
	<strong class="clear"></strong>
<?php 
$this->registerJs("
	$('#copy-guardian-address').on('click', function(){
		$('#student-address').val($('#guardian-address').val());
	});
", View::POS_READY, "copy-address");
?>