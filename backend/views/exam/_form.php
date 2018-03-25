<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Exam;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Exam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exam-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'type')->radioList(Exam::$types) ?>

    <?= $form->field($model, 'scheduled_date')->textInput()->widget(DateTimePicker::classname(), [
		'options' => ['placeholder' => 'Enter exam date & time ...'],
		'pluginOptions' => [
			'autoclose' => true,
			// 'minView' => 4,
			'format' => Yii::$app->params['jsDateTimeFormat'],
		]
	]); ?>

    <?= $form->field($model, 'status')->radioList(Exam::$statuses) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
