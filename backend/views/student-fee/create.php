<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\StudentFee */

$this->title = 'Add Fee';
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['student/index']];
$this->params['breadcrumbs'][] = ['label' => $studentModel->name, 'url' => ['student/view', 'id' => $studentModel->id]];
$this->params['breadcrumbs'][] = ['label' => 'Fees', 'url' => ['index', 'id' => $studentModel->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-fee-create">

    <?= $this->render('_form', [
        'model' => $model,
		'studentModel' => $studentModel,
    ]) ?>

</div>
