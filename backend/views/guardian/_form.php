<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\Relations;

/* @var $this yii\web\View */
/* @var $model common\models\Guardian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guardian-form">

    <?php $form = ActiveForm::begin(); ?>
	<?php if($model->photoPicture){?>
		<div class="controls">
			<img src="<?= \common\components\MediaHelper::getImageUrl($model->photoPicture->file_name)?>"/>
		</div>
	<?php }?>
	<?= $form->field($model, 'profilePictureFile')->fileInput() ?>
	
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dob')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>