<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Admission */

$this->title = 'Check Guardian';
$this->params['breadcrumbs'][] = ['label' => 'Admissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <?php $form = ActiveForm::begin(); ?>
	
		<?= $form->field($model, 'mobile')->textInput() ?>

		<div class="form-group pull-right">
			<?= Html::submitButton('Check', ['class' => 'btn btn-success']) ?>
		</div>

    <?php ActiveForm::end(); ?>
</div>