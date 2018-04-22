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
			<?php foreach($dataProvider->getModels() as $event){?>
				<li><a href="<?= $urlManager->createAbsoluteUrl(['event/view', 'id' => $event->id]);?>"><?= $event->title;?></a></li>
			<?php }?>
        </ul>
      </div>
      <div class="grid_8">
        <div class="block-1 top-5">
          <div class="block-1-shadow">
            <h2 class="clr-6 p6"><?= ($selected_event->title)?></h2>
            <p class="clr-6"><?= ($selected_event->content)?></p>
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