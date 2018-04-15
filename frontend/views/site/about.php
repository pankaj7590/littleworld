<?php
use common\models\Setting;

$this->title = 'About';
$user = Yii::$app->user;
$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;

//about page options
$aboutPageOptionModels = Setting::find()->where(['setting_group' => Setting::GROUP_ABOUT_PAGE])->all();
$aboutPageOptions = [];
foreach($aboutPageOptionModels as $model){
	$aboutPageOptions[$model->name] = $model;
}
$about_page_title = $aboutPageOptions['about_page_title']['value'];
$about_page_content = $aboutPageOptions['about_page_content']['value'];
										
$about_page_offer_title = $aboutPageOptions['about_page_offer_title']['value'];
$about_page_offer_content = $aboutPageOptions['about_page_offer_content']['value'];
?>
      <div class="grid_4 bot-1">
        <h2 class="top-6 p2">Staff</h2>
		<?php foreach($dataProvider->getModels() as $model){?>
			<img src="<?= \common\components\MediaHelper::getImageUrl(($data->profilePicture?$data->profilePicture->file_name:""))?>" alt="" class="img-border img-indent">
			<div class="clear"></div>
			<p class="text-1 p3"><?= $model->name;?></p>
			<p>Email: <?= ($model->email);?></p>
			<p>Phone: <?= ($model->phone);?></p>
			<div class="clear"></div>
		<?php }?>
      </div>
      <div class="grid_8">
        <div class="block-1 top-5">
          <div class="block-1-shadow">
            <h2 class="clr-6 p6"><?= ($about_page_title?$about_page_title:'')?></h2>
            <p class="clr-6"><?= ($about_page_content?$about_page_content:'')?></p>
            <h2 class="clr-6 p6"><?= ($about_page_offer_title?$about_page_offer_title:'')?></h2>
            <p class="clr-6"><?= ($about_page_offer_content?$about_page_offer_content:'')?></p>
          </div>
        </div>
		<?= $this->render('../layouts/_footer.php')?>
      </div>