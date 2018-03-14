<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ExamStudentSubject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exam-student-subject-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'exam_student_id')->textInput() ?>

    <?= $form->field($model, 'exam_subject_id')->textInput() ?>

    <?= $form->field($model, 'exam_id')->textInput() ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <?= $form->field($model, 'marks')->textInput() ?>

    <?= $form->field($model, 'secured_marks')->textInput() ?>

    <?= $form->field($model, 'grade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
