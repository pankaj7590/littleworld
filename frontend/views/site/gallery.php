<?php
use yii\web\View;

$this->title = 'Schedule';
$user = Yii::$app->user;
$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;
		
$this->params['selected_gallery'] = $selected_gallery;
?>
      <div class="grid_4 bot-1">
        <h2 class="top-6 p2">Our Archive</h2>
        <ul class="list-1">
			<?php foreach($dataProvider->getModels() as $gallery){?>
				<li><a href="<?= $urlManager->createAbsoluteUrl(['site/gallery', 'id' => $gallery->id]);?>"><?= $gallery->name;?></a></li>
			<?php }?>
        </ul>
      </div>
      <div class="grid_8">
        <div class="block-1 top-5">
          <div class="block-1-shadow">
            <h2 class="clr-6 p4">Our Gallery</h2>
            <div class="pag">
              <div class="img-pags">
                <ul>
					<?php foreach($selected_gallery->galleryMedia as $key => $galleryMedia){?>
						<div class="mb25 box-1 <?= ($key%2==0?'':'last')?>"> <a class="img-border"><img src="<?= \common\components\MediaHelper::getImageUrl(($galleryMedia?$galleryMedia->media->file_name:""))?>" alt=""></a></div>
					<?php }?>
                </ul>
              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
					<?= $this->render('../layouts/_footer.php')?>
      </div>
<?php
/* $this->registerJs("
	$('.gallery')
		._TMS({
		show: 0,
		pauseOnHover: true,
		prevBu: '.prev',
		nextBu: '.next',
		playBu: '.play',
		duration: 700,
		preset: 'fade',
		pagination: $('.img-pags')
			.uCarousel({
			show: 2,
			shift: 0,
			rows: 4
		}),
		pagNums: false,
		slideshow: 7000,
		numStatus: true,
		banners: false,
		waitBannerAnimation: false,
		progressBar: false
	})
", View::POS_LOAD, "init-gallery-slider"); */
?>