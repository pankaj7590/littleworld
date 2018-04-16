<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StudentFee */

$this->title = 'Update Fee: '.$model->amount;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['student/index']];
$this->params['breadcrumbs'][] = ['label' => $model->student->name, 'url' => ['student/view', 'id' => $model->student->id]];
$this->params['breadcrumbs'][] = ['label' => 'Fees', 'url' => ['index', 'id' => $model->student->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-fee-update">
    <?= $this->render('_form', [
        'model' => $model,
		'studentModel' => $model->student,
    ]) ?>

</div>
