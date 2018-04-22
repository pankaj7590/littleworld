<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
			<?php $form = ActiveForm::begin(); ?>
					<?php if($model->profilePicture){?>
						<div class="controls">
							<img src="<?= \common\components\MediaHelper::getImageUrl($model->profilePicture->file_name)?>"/>
						</div>
					<?php }?>
					<?= $form->field($model, 'profilePictureFile')->fileInput() ?>
					<?= $form->field($model, 'name')->textInput() ?>
					<?= $form->field($model, 'username')->textInput() ?>
					<?= $form->field($model, 'password')->passwordInput() ?>
					<?= $form->field($model, 'email')->textInput() ?>
					<?= $form->field($model, 'phone')->textInput() ?>
					<?= $form->field($model, 'dob')->textInput()->widget(DateTimePicker::classname(), [
						'options' => ['placeholder' => 'Enter date of birth ...'],
						'pluginOptions' => [
							'autoclose' => true,
							'minView' => 3,
							'format' => Yii::$app->params['jsDateFormat'],
						]
					]); ?>
					<?= $form->field($model, 'address')->textarea() ?>
					<?= $form->field($model, 'qualification')->textarea() ?>
					<?= $form->field($model, 'experience')->textarea() ?>
					<div class="form-group">
						<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
					</div> <!-- /form-actions -->
			<?php ActiveForm::end(); ?>

</div>
