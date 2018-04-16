<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\components\Relations;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Guardian */
/* @var $form yii\widgets\ActiveForm */
?>
	<?= $form->field($model, 'guardian_relation', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->dropdownList(Relations::$relations) ?>
	<strong class="clear"></strong>
	<?= $form->field($model, 'profilePictureFile', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->fileInput() ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'name', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['maxlength' => true]) ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'username', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['maxlength' => true]) ?>
	<strong class="clear"></strong>
	<?= $form->field($model, 'password', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->passwordInput() ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'email', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['maxlength' => true]) ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'phone', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['maxlength' => true]) ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'address', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textarea(['rows' => 6]) ?>
	<strong class="clear"></strong>
	<div class="form-group">
		<label class="control-label">
			<strong><label class="control-label" for="copy-student-address"></label></strong>
			<button type="button" id="copy-student-address" class="btn btn-default btn-xs">Copy student address</button>
		</label>
	</div>
	<strong class="clear"></strong>
    <?= $form->field($model, 'dob', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['type' => 'date', 'max' => date('Y-m-d')]); ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'create_new')->checkbox(['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}']); ?>
	<strong class="clear"></strong>
<?php 
$this->registerJs("
	$('#copy-student-address').on('click', function(){
		$('#guardian-address').val($('#student-address').val());
	});
", View::POS_READY, "copy-address");
?>