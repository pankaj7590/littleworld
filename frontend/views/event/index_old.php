<?php
use yii\widgets\ListView;
use common\components\MediaHelper;

/* @var $this yii\web\View */

$this->title = 'Events';

$this->params['breadcrumbs'][] = $this->title;

$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;
?>
<!--CONTENT BEGIN-->
    <div class="content">
        <div class="container">
            <div class="row row-offcanvas row-offcanvas-left">
                <!--event LIST BEGIN-->
				<div class="news-list col-xs-12 col-md-12">
					<p class="hidden-md hidden-lg">
						<button type="button" class="btn sidebar-btn" data-toggle="offcanvas" title="Toggle sidebar">sidebar</button>
					</p>
					<?php echo ListView::widget([
						'dataProvider' => $dataProvider,
						'itemOptions' => ['class' => 'item'],
						'itemView' => 	function($model) use($urlManager){
							$image = $model->photoPicture;
							if($image){
								return '<div class="item img-top">
												<div class="img-wrap">
													<a href="'.$urlManager->createAbsoluteUrl(['event/view', 'id' => $model->id]).'"><img src="'.MediaHelper::getImageUrl($image->file_name).'" alt="post image"></a>
												</div>
												<div class="info">
													<a href="'.$urlManager->createAbsoluteUrl(['event/view', 'id' => $model->id]).'" class="name">'.$model->title.'</a>	
													<div class="wrap">
														<a href="'.$urlManager->createAbsoluteUrl(['event/view', 'id' => $model->id]).'">'.($model->news_event_date).'</a> by <a href="'.$urlManager->createAbsoluteUrl(['event/view', 'id' => $model->id]).'">'.($model->updatedBy?$model->updatedBy->name:'Admin').'</a>
													</div>
													<div class="clear"></div>
												</div>
											</div>';
							}else{
								return '<div class="item status">
											<div class="info">
												<a href="'.$urlManager->createAbsoluteUrl(['event/view', 'id' => $model->id]).'" class="name">'.$model->title.'</a>
												<div class="wrap">
													<a href="'.$urlManager->createAbsoluteUrl(['event/view', 'id' => $model->id]).'">'.($model->news_event_date).'</a> by <a href="'.$urlManager->createAbsoluteUrl(['event/view', 'id' => $model->id]).'">'.($model->updatedBy?$model->updatedBy->name:'Admin').'</a>
												</div>
												<div class="clear"></div>
											</div>
										</div>';
							}
						},
					]) ?>
					
					<!--<div class="pagination-wrap">
						<ul class="pagination">
							<li><a href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i></a></li>
							<li><a href="#">1</a></li>
							<li class="active"><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
						</ul>
					</div>-->
				</div>
				<!--event LIST END-->
            </div>
        </div>
    </div>
    <!--CONTENT END-->