<?php
use common\models\Setting;

$this->title = 'Schedule';
$user = Yii::$app->user;
$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;

//schedule page options
$schedulePageOptionModels = Setting::find()->where(['setting_group' => Setting::GROUP_SCHEDULE_PAGE])->all();
$schedulePageOptions = [];
foreach($schedulePageOptionModels as $model){
	$schedulePageOptions[$model->name] = $model;
}
$schedule_page_title = $schedulePageOptions['schedule_page_title']['value'];
$schedule_page_sub_title = $schedulePageOptions['schedule_page_sub_title']['value'];
$schedule_page_content = $schedulePageOptions['schedule_page_content']['value'];
$schedule_page_table_content = $schedulePageOptions['schedule_page_table_content']['value'];
?>
      <div class="grid_4 bot-1">
        <h2 class="top-6 p6"><?= ($schedule_page_title?$schedule_page_title:'About Schedule')?></h2>
        <p class="clr-7 p7"><strong><?= ($schedule_page_sub_title?$schedule_page_sub_title:'At vero eos et accusam et justo duo dolores et ea rebum.')?></strong></p>
        <p class="p7"><?= ($schedule_page_content?$schedule_page_content:'Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor. Loremsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy. Eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum')?></p>
      </div>
      <div class="grid_8">
        <div class="block-1 top-5">
          <div class="block-1-shadow">
            <h2 class="clr-6 p6">Schedule</h2>
			<?php if($schedule_page_table_content){?>
				<?= $schedule_page_table_content;?> 
			<?php }else{?>
				<table class="table">
				  <tr>
					<th>Monday</th>
					<th>Wednesday</th>
					<th>Friday</th>
					<th class="last">Saturday</th>
				  </tr>
				  <tr>
					<td><span>11:00</span><span class="clr-4">Nam liber tempor</span><span>Peter Stanton</span></td>
					<td><span>11:00</span><span class="clr-4">Nam liber tempor</span><span>Peter Stanton</span></td>
					<td><span>11:00</span><span class="clr-4">Nam liber tempor</span><span>Peter Stanton</span></td>
					<td><span>11:00</span><span class="clr-4">Nam liber tempor</span><span>Peter Stanton</span></td>
				  </tr>
				  <tr>
					<td><span>13:00</span><span class="clr-4">Lorem ipsum</span><span>Helen Perton</span></td>
					<td><span>13:00</span><span class="clr-4">Lorem ipsum</span><span>Helen Perton</span></td>
					<td><span>13:00</span><span class="clr-4">Lorem ipsum</span><span>Helen Perton</span></td>
					<td><span>13:00</span><span class="clr-4">Lorem ipsum</span><span>Helen Perton</span></td>
				  </tr>
				  <tr>
					<td><span>16:00</span><span class="clr-4">Dolor sit amet</span><span>Jesica Murray</span></td>
					<td><span>16:00</span><span class="clr-4">Dolor sit amet</span><span>Jesica Murray</span></td>
					<td><span>16:00</span><span class="clr-4">Dolor sit amet</span><span>Jesica Murray</span></td>
					<td><span>16:00</span><span class="clr-4">Dolor sit amet</span><span>Jesica Murray</span></td>
				  </tr>
				</table>
			<?php }?>
            <h2 class="clr-6 p6">Events Schedule</h2>
            <div class="wrap">
              <div class="box-2">
				<?php foreach($dataProvider->getModels() as $model){?>
					<div class="p4">
					  <p><strong><?= date('M d, Y').' - "'.$model->title.'"';?></strong></p>
					  <p><?= substr($model->content, 0, 105);?> <a href="<?= $urlManager->createAbsoluteUrl(['news-event/view', 'id' => $model->id]);?>" class="link">More...</a></p>
					</div>
				<?php }?>
              </div>
            </div>
            <div class="pad-2"> <a href="<?= $urlManager->createAbsoluteUrl(['news-event/event-index']);?>" class="link-2">More Events</a> </div>
          </div>
        </div>
					<?= $this->render('../layouts/_footer.php')?>
      </div>