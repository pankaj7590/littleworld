<?php
$this->title = 'About';
$user = Yii::$app->user;
$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;
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
            <h2 class="clr-6 p6">A Few Words About Us</h2>
            <p class="clr-6"><strong>Consetetur sadipscing elitr, sed diam nonumy eirmod tempor </strong></p>
            <p class="clr-6">Invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et acam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est lorem ipsum dolor sit amet.</p>
            <div class="pad-3"> <img src="<?= $baseUrl?>/images/page2-img1.jpg" alt="" class="img-border img-indent">
              <div class="extra-wrap clr-6">
                <p><strong>Lorem ipsum dolor sit amet, consetetur</strong></p>
                <p>sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
              </div>
            </div>
            <h2 class="clr-6 p6">What We Offer</h2>
            <p class="clr-6"><strong>Nam liber tempor cum soluta nobis eleifend option</strong></p>
            <p class="clr-6">Congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit:</p>
            <div class="lists">
              <ul class="list-2">
                <li><a href="#">Sed diam nonummy nibh euismod</a></li>
                <li><a href="#">Tincidunt ut laoreet dolore</a></li>
                <li><a href="#">Magna aliquam erat volutpat wisi enim</a></li>
                <li><a href="#">Minim veniam, quis nostrud exerci</a></li>
              </ul>
              <ul class="list-2 last">
                <li><a href="#">Duis autem vel eum iriure dolor</a></li>
                <li><a href="#">Hendrerit in vulputate velit molestie</a></li>
                <li><a href="#">Consequat vel illum dolore</a></li>
                <li><a href="#">Feugiat nulla facilisis at vero eros</a></li>
              </ul>
            </div>
          </div>
        </div>
					<?= $this->render('../layouts/_footer.php')?>
      </div>