<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Admission */

$this->title = 'Admission';
$this->params['breadcrumbs'][] = ['label' => 'Admissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admission-create">
    <?php $form = ActiveForm::begin(); ?>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading"><i class="fa fa-area-chart"></i> Student Information</div>
					<div class="panel-body">
						<?= $this->render('_student_form', [
							'model' => $studentModel,
							'form' => $form,
						]) ?>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading"><i class="fa fa-area-chart"></i> Admission Information</div>
					<div class="panel-body">
						<?= $this->render('_form', [
							'model' => $model,
							'form' => $form,
						]) ?>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading"><i class="fa fa-area-chart"></i> Guardian Information</div>
					<div class="panel-body">
						<?= $this->render('_guardian_form', [
							'model' => $guardianModel,
							'form' => $form,
						]) ?>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group pull-right">
			<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
		</div>

    <?php ActiveForm::end(); ?>
</div>