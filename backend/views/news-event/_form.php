<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\NewsEvent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-event-form">

    <?php $form = ActiveForm::begin(); ?>

	<?php if($model->photoPicture){?>
		<div class="controls">
			<img src="<?= \common\components\MediaHelper::getImageUrl($model->photoPicture->file_name)?>" width="200px"/>
		</div>
	<?php }?>
	<?= $form->field($model, 'photoPictureFile')->fileInput() ?>
					
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'news_event_date')->textInput()->widget(DateTimePicker::classname(), [
		'options' => ['placeholder' => 'Enter date & time ...'],
		'pluginOptions' => [
			'autoclose' => true,
			// 'minView' => 4,
			'format' => Yii::$app->params['jsDateTimeFormat'],
		]
	]); ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
