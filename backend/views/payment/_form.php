<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Payment;

/* @var $this yii\web\View */
/* @var $model common\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'guardian_id')->dropdownList(ArrayHelper::map($guardians, 'id', 'name'), ['prompt' => 'Select guardian to see students']) ?>

	<?php if($model->isNewRecord){?>
		<?= $form->field($model, 'student_id')->dropdownList([], ['prompt' => 'Select guardian to see students']) ?>
	<?php }else{?>
		<?= $form->field($model, 'student_id')->dropdownList(ArrayHelper::map($model->guardian->studentGuardians, 'student.id', 'student.name'), ['prompt' => 'Select guardian to see students']) ?>
	<?php }?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'status')->radioList(Payment::$statuses) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("
	$('#payment-guardian_id').on('change', function(){
		var id = $(this).val();
		if(typeof id != 'undefined'){
			$.ajax({
				type: 'post',
				url: '".Yii::$app->urlManager->createAbsoluteUrl(['payment/get-students'])."',
				data:{id:id},
				success:function(data){
					if(data){
						var data = JSON.parse(data);
						var options = '';
						$.each(data, function(k,v){
							options += '<option value='+k+'>'+v+'</option>'; 
						});
						$('#payment-student_id').html(options);
					}else{
						$('#payment-student_id').html('');
					}
				}
			});
		}
	});
");
?>