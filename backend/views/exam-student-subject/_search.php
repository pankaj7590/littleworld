<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ExamStudentSubjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exam-student-subject-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'exam_student_id') ?>

    <?= $form->field($model, 'exam_subject_id') ?>

    <?= $form->field($model, 'exam_id') ?>

    <?= $form->field($model, 'student_id') ?>

    <?php // echo $form->field($model, 'marks') ?>

    <?php // echo $form->field($model, 'secured_marks') ?>

    <?php // echo $form->field($model, 'grade') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
