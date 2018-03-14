<?php
$this->title = 'Schedule';
$user = Yii::$app->user;
$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;
?>
      <div class="grid_4 bot-1">
        <h2 class="top-6 p6">About Schedule</h2>
        <p class="clr-7 p7"><strong>At vero eos et accusam et justo duo dolores et ea rebum.</strong></p>
        <p class="p7">Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor. Loremsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy.</p>
        <p>Eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum <br>
          dolor sit amet <a href="#" class="link">More...</a></p>
      </div>
      <div class="grid_8">
        <div class="block-1 top-5">
          <div class="block-1-shadow">
            <h2 class="clr-6 p6">Schedule</h2>
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
            <h2 class="clr-6 p6">Events Schedule</h2>
            <div class="wrap">
              <div class="box-2">
                <div class="p4">
                  <p><strong>April 10, 2012</strong></p>
                  <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore <a href="#" class="link">More...</a></p>
                </div>
                <div>
                  <p><strong>March 22, 2012</strong></p>
                  <p>Teugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum <a href="#" class="link">More...</a></p>
                </div>
              </div>
              <div class="box-2 last">
                <div class="p4">
                  <p><strong>April 04, 2012</strong></p>
                  <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore <a href="#" class="link">More...</a></p>
                </div>
                <div>
                  <p><strong>March 14, 2012</strong></p>
                  <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus <a href="#" class="link">More...</a></p>
                </div>
              </div>
            </div>
            <div class="pad-2"> <a href="<?= $urlManager->createAbsoluteUrl(['news-events/index']);?>" class="link-2">More Events</a> </div>
          </div>
        </div>
					<?= $this->render('../layouts/_footer.php')?>
      </div>