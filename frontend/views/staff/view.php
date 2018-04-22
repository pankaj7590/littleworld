<?php
use common\components\MediaHelper;

/* @var $this yii\web\View */

$this->title = $model->name;

$this->params['breadcrumbs'][] = $this->title;

$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;
?>
      <div class="grid_4 bot-1">
        <h2 class="top-6 p2"></h2>
        <ul class="list-1">
			<?php foreach($staff as $single_staff){?>
				<li><a href="<?= $urlManager->createAbsoluteUrl(['staff/view', 'id' => $single_staff->id]);?>"><?= $single_staff->name;?></a></li>
			<?php }?>
        </ul>
      </div>
      <div class="grid_8">
        <div class="block-1 top-5">
          <div class="block-1-shadow">
            <h2 class="clr-6 p6"><?= ($model->name)?></h2>
			<div class="pad-3"> 
				<?php if($model->profilePicture){?>
					<img src="<?= MediaHelper::getImageUrl($model->profilePicture->file_name)?>" alt="" class="img-border" style="width:235px;">
				<?php }?>
              <div class="extra-wrap clr-6">
                <h4>Date Of Birth:</h4> 
				<p><?= ($model->dob?$model->dob:'NA')?></p>
                <h4>Qualification:</h4> 
				<p><?= ($model->qualification?$model->qualification:'NA')?></p>
                <h4>Experience:</h4> 
				<p><?= ($model->experience?$model->experience:'NA')?></p>
                <h4>Address:</h4> 
				<p><?= ($model->address?$model->address:'NA')?></p>
              </div>
            </div>
          </div>
        </div>
		<?= $this->render('../layouts/_footer.php')?>
      </div>