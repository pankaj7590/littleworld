<?php
$this->title = 'My '.(count($dataProvider->getModels()) == 1?'Child':'Children');
$user = Yii::$app->user;
$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;
?>
      <div class="grid_4 bot-1">
        <h2 class="top-6 p2">My <?= (count($dataProvider->getModels()) == 1?'Child':'Children')?></h2>
		<?php foreach($dataProvider->getModels() as $model){?>
			<img src="<?= \common\components\MediaHelper::getImageUrl(($model->photoPicture?$model->photoPicture->file_name:""))?>" alt="" class="img-border img-indent" style="width:100px;">
			<p class="text-1 p3"><?= $model->name;?></p>
			<p>Division: <?= ($model->currentDivision?$model->currentDivision->division->name:'NA');?></p>
			<p>Date Of Birth: <?= ($model->dob?$model->dob:'NA');?></p>
			<p>Address: <?= $model->address;?></p>
		<?php }?>
      </div>
      <div class="grid_8">
        <div class="block-1 top-5">
          <div class="block-1-shadow">
            <h2 class="clr-6 p6">Exam Schedule</h2>
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
            <h2 class="clr-6 p6">Report Card</h2>
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
          </div>
        </div>
					<?= $this->render('../layouts/_footer.php')?>
      </div>