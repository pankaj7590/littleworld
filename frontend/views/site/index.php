<?php
use common\models\Setting;

$this->title = Yii::$app->name.' - Home';
$user = Yii::$app->user;
$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;

//home page options
$homePageOptionModels = Setting::find()->where(['setting_group' => Setting::GROUP_HOME_PAGE])->all();
$homePageOptions = [];
foreach($homePageOptionModels as $model){
	$homePageOptions[$model->name] = $model;
}
$home_page_title = $homePageOptions['home_page_title']['value'];
$home_page_content = $homePageOptions['home_page_content']['value'];
?>
				  <div class="grid_4 bot-1">
					<div class="art"></div>
					<h2 class="top-1 p2">Events</h2>
					<?php foreach($dataProvider->getModels() as $model){?>
						<img src="<?= \common\components\MediaHelper::getImageUrl(($data->photoPicture?$data->photoPicture->file_name:""))?>" alt="" class="img-border img-indent">
						<div class="clear"></div>
						<p class="text-1 p3"><?= date('M d').' - "'.$model->title.'"';?></p>
						<p><?= $model->content;?></p>
						<div class="clear"></div>
					<?php }?>
					<a href="<?= $urlManager->createAbsoluteUrl(['news-event/event-index'])?>" class="link-1 top-3">All Events</a> </div>
				  <div class="grid_8">
					<div class="pad-1">
					  <h2 class="p2"><?= ($home_page_title?$home_page_title:'Welcome to Little World')?></h2>
					  <p class="text-1"><?= ($home_page_content?$home_page_content:'Art School is one of free website templates by TemplateMonster.com team. This template is optimized for 1280X1024 screen resolution. It is also XHTML & CSS valid.')?></p>
					</div>
					<div class="block-1">
					  <div class="block-1-shadow">
						<h2 class="clr-6 p4">Our Gallery</h2>
						<div class="box-1"> <a href="#" class="img-border"><img src="<?= $baseUrl?>/images/img1.jpg" alt=""></a>
						  <p class="text-2">Jennifer, 10 years</p>
						</div>
						<div class="box-1 last"> <a href="#" class="img-border"><img src="<?= $baseUrl?>/images/img2.jpg" alt=""></a>
						  <p class="text-2">Martin, 13 years</p>
						</div>
						<div class="clear p5"></div>
						<div class="box-1"> <a href="#" class="img-border"><img src="<?= $baseUrl?>/images/img3.jpg" alt=""></a>
						  <p class="text-2">Sebastian, 14 years</p>
						</div>
						<div class="box-1 last"> <a href="#" class="img-border"><img src="<?= $baseUrl?>/images/img4.jpg" alt=""></a>
						  <p class="text-2">Fiona, 8 years</p>
						</div>
						<div class="clear"></div>
						<div class="pad-2"> <a href="<?= $urlManager->createAbsoluteUrl(['site/gallery']);?>" class="link-2">Full Gallery</a> </div>
					  </div>
					</div>
					<?= $this->render('../layouts/_footer.php')?>
				  </div>