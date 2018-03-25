<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Admission */

$this->title = 'Update Admission: '.($model->student?$model->student->name:$model->id);
$this->params['breadcrumbs'][] = ['label' => 'Admissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => ($model->student?$model->student->name:$model->id), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admission-update">
    <?php $form = ActiveForm::begin(); ?>
		<?= $this->render('_form', [
			'model' => $model,
			'form' => $form,
		]) ?>

		<div class="form-group pull-right">
			<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
		</div>

    <?php ActiveForm::end(); ?>
</div>
