<?php
use yii\web\View;

$this->title = 'Schedule';
$user = Yii::$app->user;
$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;
?>
      <div class="grid_4 bot-1">
        <h2 class="top-6 p2">Our Archive</h2>
        <ul class="list-1">
          <li><a href="#">April, 2012</a></li>
          <li><a href="#">March, 2012</a></li>
          <li><a href="#">February, 2012</a></li>
          <li><a href="#">January, 2012</a></li>
          <li><a href="#">December, 2011</a></li>
          <li><a href="#">November, 2011</a></li>
          <li><a href="#">October, 2011</a></li>
          <li><a href="#">September, 2011</a></li>
          <li><a href="#">August, 2011</a></li>
          <li><a href="#">July, 2011</a></li>
          <li><a href="#">June, 2011</a></li>
          <li><a href="#">May, 2011</a></li>
        </ul>
      </div>
      <div class="grid_8">
        <div class="block-1 top-5">
          <div class="block-1-shadow">
            <h2 class="clr-6 p4">Our Gallery</h2>
            <div class="pag">
              <div class="img-pags">
                <ul>
                  <li><a href="#"><span><img src="<?= $baseUrl?>/images/gallery-1.jpg" alt="" class="img-border"> <strong class="text-2">Jennifer, 10 years</strong></span></a></li>
                  <li><a href="#"><span><img src="<?= $baseUrl?>/images/gallery-2.jpg" alt="" class="img-border"> <strong class="text-2">Sebastian, 14 years</strong></span></a></li>
                  <li><a href="#"><span><img src="<?= $baseUrl?>/images/gallery-3.jpg" alt="" class="img-border"> <strong class="text-2">Peter, 9 years</strong></span></a></li>
                  <li><a href="#"><span><img src="<?= $baseUrl?>/images/gallery-4.jpg" alt="" class="img-border"> <strong class="text-2">Samuel, 15 years</strong></span></a></li>
                  <li><a href="#"><span><img src="<?= $baseUrl?>/images/gallery-5.jpg" alt="" class="img-border"> <strong class="text-2">Martin, 13 years</strong></span></a></li>
                  <li><a href="#"><span><img src="<?= $baseUrl?>/images/gallery-6.jpg" alt="" class="img-border"> <strong class="text-2">Fiona, 8 years</strong></span></a></li>
                  <li><a href="#"><span><img src="<?= $baseUrl?>/images/gallery-7.jpg" alt="" class="img-border"> <strong class="text-2">Monica, 7 years</strong></span></a></li>
                  <li><a href="#"><span><img src="<?= $baseUrl?>/images/gallery-8.jpg" alt="" class="img-border"> <strong class="text-2">Fiona, 8 years</strong></span></a></li>
                </ul>
              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
					<?= $this->render('../layouts/_footer.php')?>
      </div>
<?php
$this->registerJs("
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
", View::POS_LOAD, "init-gallery-slider");
?>