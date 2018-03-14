<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ExamStudentSubject */

$this->title = 'Create Exam Student Subject';
$this->params['breadcrumbs'][] = ['label' => 'Exam Student Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-student-subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
