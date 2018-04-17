<?php
use common\models\Exam;

$this->title = 'My '.(count($dataProvider->getModels()) == 1?'Child':'Children');
$user = Yii::$app->user;
$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;
?>
      <div class="grid_4 bot-1">
        <h2 class="top-6 p2">My <?= (count($dataProvider->getModels()) == 1?'Child':'Children')?></h2>
		<?php foreach($dataProvider->getModels() as $model){?>
			<img src="<?= \common\components\MediaHelper::getImageUrl(($model->photoPicture?$model->photoPicture->file_name:""))?>" alt="" class="img-border img-indent" style="width:100px;">
			<p class="text-1 p3"><?= $model->name;?></p>
			<p>Division: <?= ($model->currentDivision?$model->currentDivision->division->name:'NA');?></p>
			<p>Date Of Birth: <?= ($model->dob?$model->dob:'NA');?></p>
			<p>Address: <?= $model->address;?></p>
			<div class="clear"></div>
		<?php }?>
      </div>
      <div class="grid_8">
        <div class="block-1 top-5">
          <div class="block-1-shadow">
            <h2 class="clr-6 p6">Exam Schedule</h2>
            <table class="table">
              <tr>
                <th>Year</th>
                <th>Name</th>
                <th>Type</th>
                <th>Scheduled Date</th>
                <th>Status</th>
              </tr>
			  <?php foreach($examModels as $exam){?>
				  <tr>
					<td><span class="clr-4"><?= $exam->year;?></span></td>
					<td><span class="clr-4"><?= $exam->name;?></span></td>
					<td><span class="clr-4"><?= ($exam->type?Exam::$types[$exam->type]:'-');?></span></td>
					<td><span class="clr-4"><?= $exam->scheduled_date;?></span></td>
					<td><span class="clr-4"><?= Exam::$statuses[$exam->status];?></span></td>
				  </tr>
			  <?php }?>
            </table>
			<?php if($examStudentSubjects){?>
				<h2 class="clr-6 p6">Report Card</h2>
				<table class="table">
				  <tr>
					<th>Exam</th>
					<?php foreach($examStudentSubjects as $examStudentSubject){?>
						<th><?= $examStudentSubject->subject;?></th>
					<?php }?>
				  </tr>
				  <?php foreach($examStudentSubjects as $examStudentSubject){?>
					  <tr>
						<td><span><?= $examStudentSubject['exam']?></span></td>
						<?php foreach($examStudentSubject['marks'] as $marks){?>
							<td><span><?= $marks->secured_marks.'/'.$marks->out_of_marks?></span><span class="clr-4"><?= $marks->grade.'-'.$marks->remarks?></span></td>
						<?php }?>
					  </tr>
				  <?php }?>
				</table>
			<?php }?>
          </div>
        </div>
	<?= $this->render('../layouts/_footer.php')?>
	</div>