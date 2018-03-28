<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ExamSubject */

$this->title = 'Update Subject: '.$model->subject->name;
$this->params['breadcrumbs'][] = ['label' => 'Exams', 'url' => ['exam/index']];
$this->params['breadcrumbs'][] = ['label' => $model->exam->name, 'url' => ['exam/view', 'id' => $model->exam_id]];
$this->params['breadcrumbs'][] = ['label' => 'Subjects', 'url' => ['index', 'id' => $model->exam_id]];
$this->params['breadcrumbs'][] = ['label' => $model->subject->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exam-subject-update">

    <?= $this->render('_form', [
        'model' => $model,
		'subjects' => $subjects,
    ]) ?>

</div>
