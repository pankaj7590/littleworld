<?php
$this->title = Yii::$app->name.' - Home';
$user = Yii::$app->user;
$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;
?>
				  <div class="grid_4 bot-1">
					<div class="art"></div>
					<h2 class="top-1 p2">Events</h2>
					<p class="text-1 p3">April 18 - “Spring’s Bloom”</p>
					<p>The PSD source files of this Art School Template are available for free for the registered members of TemplateMonster.com. Feel free to <br>
					  get them!</p>
					<p class="text-1 top-2 p3">April 01 - “Smile!”</p>
					<p>This website template has several pages: Home Page, About Us, Schedule, Gallery, Contact Us (note that contact us form – <br>
					  doesn’t work).</p>
					<a href="#" class="link-1 top-3">News Archive</a> </div>
				  <div class="grid_8">
					<div class="pad-1">
					  <h2 class="p2">Welcome to Art School</h2>
					  <p class="text-1">Art School is one of free website templates by TemplateMonster.com team. This template is optimized for 1280X1024 screen resolution. It is also XHTML & CSS valid.</p>
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