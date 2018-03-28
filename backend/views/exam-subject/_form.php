<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\ExamSubject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exam-subject-form">

    <?php $form = ActiveForm::begin(); ?>

	<?php if($model->isNewRecord){?>
		<?= $form->field($model, 'subject_id')->widget(Select2::classname(), [
			'data' => $subjects,
			'options' => ['placeholder' => 'Select subjects ...', 'multiple' => true],
			'pluginOptions' => [
				'allowClear' => true
			],
		]);?>
	<?php }else{?>
		<?= $form->field($model, 'subject_id')->widget(Select2::classname(), [
			'data' => $subjects,
			'options' => ['placeholder' => 'Select subjects ...', 'readonly' => true],
			'pluginOptions' => [
				'allowClear' => true
			],
		]);?>
	<?php }?>

    <?= $form->field($model, 'marks')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
