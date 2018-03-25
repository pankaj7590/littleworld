<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\DivisionStudent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="division-student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_id')->widget(Select2::classname(), [
		'data' => $students,
		'options' => ['placeholder' => 'Select students ...', 'multiple' => true],
		'pluginOptions' => [
			'allowClear' => true
		],
	]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
