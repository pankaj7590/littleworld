<?php
use yii\web\View;

$this->title = 'Contact';
$user = Yii::$app->user;
$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;
?>
      <div class="grid_4 bot-1">
        <h2 class="top-6">Contact Us</h2>
        <div class="map">
          <iframe src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Brooklyn,+New+York,+NY,+United+States&amp;aq=0&amp;sll=37.0625,-95.677068&amp;sspn=61.282355,146.513672&amp;ie=UTF8&amp;hq=&amp;hnear=Brooklyn,+Kings,+New+York&amp;ll=40.649974,-73.950005&amp;spn=0.01628,0.025663&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
        </div>
        <dl>
          <dt>8901 Marmora Road, <br>
            Glasgow, D04 89GR.</dt>
          <dd><span>Telephone: </span>+1 800 603 6035</dd>
          <dd><span>E-mail: </span><a href="#" class="link">mail@demolink.org</a></dd>
        </dl>
      </div>
      <div class="grid_8">
        <div class="block-1 top-5">
          <div class="block-1-shadow">
            <h2 class="clr-6">Contact Form</h2>
            <form id="form" method="post" action="#">
              <fieldset>
                <label><strong>Name:</strong>
                  <input type="text" value="">
                  <strong class="clear"></strong></label>
                <label><strong>Email:</strong>
                  <input type="text" value="">
                  <strong class="clear"></strong></label>
                <label><strong>Phone:</strong>
                  <input type="text" value="">
                  <strong class="clear"></strong></label>
                <label><strong>Message:</strong>
                  <textarea></textarea>
                  <strong class="clear"></strong></label>
                <strong class="clear"></strong>
                <div class="btns pad-2"><a href="#" class="link-2">Clear</a><a href="#" class="link-2">Send</a></div>
              </fieldset>
            </form>
          </div>
        </div>
					<?= $this->render('../layouts/_footer.php')?>
      </div>