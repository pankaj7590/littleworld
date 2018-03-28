<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExamStudentSubjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exam Student Subjects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-student-subject-index table-responsive">
	<form method='post' action='<?= Yii::$app->urlManager->createAbsoluteUrl(['exam-student-subject/index', 'id' => $examModel->id]);?>'>
		<input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th rowspan="2">Students\Subjects</th>
					<?php foreach($examModel->examSubjects as $examSubject){?>
						<th colspan='4' class='text-center'><?= $examSubject->subject->name;?></th>
					<?php }?>
				</tr>
				<tr>
					<?php foreach($examModel->examSubjects as $examSubject){?>
						<th class='text-center'>Secured Marks</th>
						<th class='text-center'>Out Of Marks</th>
						<th class='text-center'>Grade</th>
						<th class='text-center'>Remarks</th>
					<?php }?>
				</tr>
			</thead>
			<tbody>
				<?php foreach($students as $student){?>
					<tr>
						<td><?= $student->name;?></td>
						<?php 
							foreach($examModel->examSubjects as $examSubject){
								$examStudentSubject = $student->getExamStudentSubject($examModel->id, $examSubject->id)->one();
								$secured_marks = ($examStudentSubject && $examStudentSubject->secured_marks!==null?$examStudentSubject->secured_marks:null);
								$grade = ($examStudentSubject && $examStudentSubject->grade?$examStudentSubject->grade:null);
								$remarks = ($examStudentSubject && $examStudentSubject->remarks?$examStudentSubject->remarks:null);
						?>
							<td><input type='number' name='ExamStudentSubject[<?= $student->id?>][<?= $examSubject->id?>][secured_marks]' value='<?= $secured_marks?>'></td>
							<td><input type='number' readonly name='ExamStudentSubject[<?= $student->id?>][<?= $examSubject->id?>][marks]' value='<?= $examSubject->marks?>'></td>
							<td><input name='ExamStudentSubject[<?= $student->id?>][<?= $examSubject->id?>][grade]' value='<?= $grade?>'></td>
							<td><input name='ExamStudentSubject[<?= $student->id?>][<?= $examSubject->id?>][remarks]' value='<?= $remarks?>'></td>
						<?php }?>
					</tr>
				<?php }?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="<?= (count($examModel->examSubjects)*4)+1?>">
						<input type='submit' value='Save' class='btn btn-success'/>
					</td>
				</tr>
			</tfoot>
		</table>
	</form>
</div>
