<?php
use common\components\MediaHelper;

/* @var $this yii\web\View */

$this->title = $model->title;

$this->params['breadcrumbs'][] = $this->title;

$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;
?>
      <div class="grid_4 bot-1">
        <h2 class="top-6 p2"></h2>
        <ul class="list-1">
			<?php foreach($recentEvents as $event){?>
				<li><a href="<?= $urlManager->createAbsoluteUrl(['event/view', 'id' => $event->id]);?>"><?= $event->title;?></a></li>
			<?php }?>
        </ul>
      </div>
      <div class="grid_8">
        <div class="block-1 top-5">
          <div class="block-1-shadow">
            <h2 class="clr-6 p6"><?= ($model->title)?></h2>
            <h4 class="clr-6 p6"><?= ($model->news_event_date)?></h4>
			<div class="pad-3"> 
				<?php if($model->photoPicture){?>
					<img src="<?= MediaHelper::getImageUrl($model->photoPicture->file_name)?>" alt="" class="img-border" style="width:100%">
				<?php }?>
              <div class="extra-wrap clr-6">
                <p><?= ($model->content)?></p>
              </div>
            </div>
          </div>
        </div>
		<?= $this->render('../layouts/_footer.php')?>
      </div>