<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ExamSubject */

$this->title = 'Add Subjects';
$this->params['breadcrumbs'][] = ['label' => 'Exams', 'url' => ['exam/index']];
$this->params['breadcrumbs'][] = ['label' => $model->exam->name, 'url' => ['exam/view', 'id' => $model->exam_id]];
$this->params['breadcrumbs'][] = ['label' => 'Subjects', 'url' => ['index', 'id' => $model->exam_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-subject-create">

    <?= $this->render('_form', [
        'model' => $model,
        'subjects' => $subjects,
    ]) ?>

</div>
