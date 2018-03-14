<?php
$this->title = 'About';
$user = Yii::$app->user;
$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;
?>
      <div class="grid_4 bot-1">
        <h2 class="top-6 p2">Teachers</h2>
        <p class="text-1 p3">Peter Stanton</p>
        <p>Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat <a href="#" class="link">More...</a></p>
        <p class="text-1 top-2 p3">Helen Perton</p>
        <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est <a href="#" class="link">More...</a></p>
        <p class="text-1 top-2 p3">Jesica Murray</p>
        <p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, <br>
          sed diam <a href="#" class="link">More...</a></p>
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
            <div class="pad-2"> <a href="#" class="link-2">Read More</a> </div>
          </div>
        </div>
					<?= $this->render('../layouts/_footer.php')?>
      </div>