<?php
use common\components\MediaHelper;

/* @var $this yii\web\View */

$this->title = $model->title;

$this->params['breadcrumbs'][] = $this->title;

$urlManager = Yii::$app->urlManager;
$baseUrl = $urlManager->baseUrl;
?>
<!--CONTENT BEGIN-->
    <div class="content">
        <div class="container">
            <div class="row row-offcanvas row-offcanvas-left">
                <!--SIEDBAR BEGIN-->
                <section class="sidebar col-xs-6 col-sm-6 col-md-3 sidebar-offcanvas" id="sidebar">
                    <div class="recent-news">
                        <h6>recent news</h6>
						<?php foreach($recentNews as $recent){?>
							<div class="item">
								<div class="date"><a href="<?= $urlManager->createAbsoluteUrl(['news/view', 'id' => $recent->id]);?>"><?= $recent->news_event_date?></a> in <a href="<?= $urlManager->createAbsoluteUrl(['news/view', 'id' => $recent->id]);?>">highlights</a></div>
								<a href="<?= $urlManager->createAbsoluteUrl(['news/view', 'id' => $recent->id]);?>" class="name"><?= substr($recent->content, 0, 45)?></a>
							</div>
						<?php }?>
                    </div>
                </section>	
                <!--SIEDBAR END-->
                <!--NEWS SINGLE BEGIN-->
                <section class="news-single col-xs-12 col-sm-12 col-md-9">
                    <p class="hidden-md hidden-lg">
                        <button type="button" class="btn sidebar-btn" data-toggle="offcanvas" title="Toggle sidebar">sidebar</button>
                    </p>
                    <div class="item">
                        <div class="top-info">
                            <div class="date"><a href="#"><?= $model->news_event_date?></a> by <a href="#"><?= ($model->createdBy?$model->createdBy->name:'Admin')?></a></div>
                        </div>
						<?php if($model->newsEventPhoto){?>
                        <div class="img-wrap">
                            <img src="<?= MediaHelper::getImageUrl($model->newsEventPhoto->file_name);?>" alt="news-single">
                        </div>
						<?php }?>
                        <div class="post-text">
                            <p><?= $model->content?></p>
                        </div>
                        <div class="author-box">
                            <div class="top">
                                <div class="avatar"><img src="<?= MediaHelper::getImageUrl(($model->createdBy?($model->createdBy->profilePicture?$model->createdBy->profilePicture->file_name:null):''));?>" alt="author-avatar"></div>
                                <div class="info">
                                    <div class="name"><?= ($model->createdBy?$model->createdBy->name:'Admin')?></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
                <!--NEWS SINGLE END-->
            </div>
        </div>
    </div>
    <!--CONTENT END-->