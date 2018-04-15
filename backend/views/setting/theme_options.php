<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use common\components\MediaHelper;
use common\models\Media;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Theme Options';
$this->params['breadcrumbs'][] = $this->title;
$urlManager = Yii::$app->urlManager;
?>
<div class="row">
	<div class="col-lg-12">
				<div class="panel-group" id="accordion">
					<form id="theme-options-form" method="post" enctype="multipart/form-data">
						<input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#headerContent">Header</a>
								</h4>
							</div>
							<div id="headerContent" class="panel-collapse collapse">
								<div class="panel-body">
									<div class="row">
										<?php 
											$facebook = $headerOptions['facebook']['value'];
											$twitter = $headerOptions['twitter']['value'];
											$gplus = $headerOptions['gplus']['value'];
											$pinterest = $headerOptions['pinterest']['value'];
											$instagram = $headerOptions['instagram']['value'];
											$menu_bar_logo = $headerOptions['menu_bar_logo'];
											
											echo '<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">';
												if($menu_bar_logo->media){
													echo "<div class='setting-media-container'>";
														echo "<img src='".MediaHelper::getImageUrl($menu_bar_logo->media->file_name)."' width='100px'>";
													echo "</div>";
												}
												echo '<label class="control-label" for="themeoption-menu_bar_logo">Menu Bar Logo</label>';
												echo '<input type="file" id="themeoption-menu_bar_logo" name="menu_bar_logo">';
											echo '</div>';
											echo '<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12">';
												echo '<label class="control-label" for="themeoption-twitter">Twitter</label>';
												echo '<input type="text" id="themeoption-twitter" class="form-control" name="twitter" value="'.$twitter.'"/>';
												echo '<label class="control-label" for="themeoption-facebook">Facebook</label>';
												echo '<input type="text" id="themeoption-facebook" class="form-control" name="facebook" value="'.$facebook.'">';
											echo '</div>';
											echo '<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12">';
												echo '<label class="control-label" for="themeoption-gplus">G+</label>';
												echo '<input type="text" id="themeoption-gplus" class="form-control" name="gplus" value="'.$gplus.'">';
												echo '<label class="control-label" for="themeoption-pinterest">Pinterest</label>';
												echo '<input type="text" id="themeoption-pinterest" class="form-control" name="pinterest" value="'.$pinterest.'"/>';
											echo '</div>';
											echo '<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12">';
												echo '<label class="control-label" for="themeoption-instagram">Instagram</label>';
												echo '<input type="text" id="themeoption-instagram" class="form-control" name="instagram" value="'.$instagram.'">';
											echo '</div>';
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#footerContent">Footer</a>
								</h4>
							</div>
							<div id="footerContent" class="panel-collapse collapse">
								<div class="panel-body">
									<?php 
										$footer_developer = $footerOptions['footer_developer']['value'];
										$footer_developer_link = $footerOptions['footer_developer_link']['value'];
										$footer_copyright = $footerOptions['footer_copyright']['value'];
										echo '<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12">';
											echo '<label class="control-label" for="themeoption-footer_developer">Developer</label>';
											echo '<input type="text" id="themeoption-footer_developer" class="form-control" name="footer_developer" value="'.$footer_developer.'">';
											echo '<label class="control-label" for="themeoption-footer_developer_link">Developer Link</label>';
											echo '<input type="text" id="themeoption-footer_developer_link" class="form-control" name="footer_developer_link" value="'.$footer_developer_link.'">';
											echo '<label class="control-label" for="themeoption-footer_copyright">Copyright</label>';
											echo '<input type="text" id="themeoption-footer_copyright" class="form-control" name="footer_copyright" value="'.$footer_copyright.'">';
										echo '</div>';
									?>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#homePage">Home Page</a>
								</h4>
							</div>
							<div id="homePage" class="panel-collapse collapse">
								<div class="panel-body">
									<?php 
										$main_slider_images = $homePageOptions['main_slider_images'];
										$home_page_title = $homePageOptions['home_page_title']['value'];
										$home_page_content = $homePageOptions['home_page_content']['value'];
										
										if($main_slider_images->value){
											$logos = json_decode($main_slider_images->value);
											foreach($logos as $logo){
												echo '<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12">';
													$logoModel = Media::findOne($logo);
													if($logoModel){
														echo "<div class='setting-media-container mt20 float-left'>";
															echo "<img src='".MediaHelper::getImageUrl($logoModel->file_name)."' width='100%'>";
														echo "</div>";
													}
												echo '</div>';
											}
											echo "<div class='clearfix'></div>";
										}
										echo '<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12">';
											echo '<label class="control-label" for="themeoption-main_slider_images">Slider Images</label>';
											echo '<input type="file" id="themeoption-main_slider_images" name="main_slider_images[]" multiple/>';
										echo '</div>';
										echo '<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">';
											echo '<label class="control-label" for="themeoption-home_page_title">Title</label>';
											echo '<input type="text" id="themeoption-home_page_title" class="form-control" name="home_page_title" value="'.$home_page_title.'"/>';
										echo '</div>';
										echo '<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">';
											echo '<label class="control-label" for="themeoption-home_page_content">Content</label>';
											echo '<textarea id="themeoption-home_page_content" class="form-control" name="home_page_content" rows="5">'.$home_page_content.'</textarea>';
										echo '</div>';
									?>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#aboutPage">About Page</a>
								</h4>
							</div>
							<div id="aboutPage" class="panel-collapse collapse">
								<div class="panel-body">
									<?php 
										$about_page_title = $aboutPageOptions['about_page_title']['value'];
										$about_page_content = $aboutPageOptions['about_page_content']['value'];
										
										echo '<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">';
											echo '<label class="control-label" for="themeoption-about_page_title">Title</label>';
											echo '<input type="text" id="themeoption-about_page_title" class="form-control" name="about_page_title" value="'.$about_page_title.'"/>';
										echo '</div>';
										echo '<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">';
											echo '<label class="control-label" for="themeoption-about_page_content">Content</label>';
											echo '<textarea id="themeoption-about_page_content" class="form-control" name="about_page_content" rows="5">'.$about_page_content.'</textarea>';
										echo '</div>';
										
										$about_page_offer_title = $aboutPageOptions['about_page_offer_title']['value'];
										$about_page_offer_content = $aboutPageOptions['about_page_offer_content']['value'];
										
										echo '<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">';
											echo '<label class="control-label" for="themeoption-about_page_offer_title">Offer Title</label>';
											echo '<input type="text" id="themeoption-about_page_offer_title" class="form-control" name="about_page_offer_title" value="'.$about_page_offer_title.'"/>';
										echo '</div>';
										echo '<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">';
											echo '<label class="control-label" for="themeoption-about_page_offer_content">Offer Content</label>';
											echo '<textarea id="themeoption-about_page_offer_content" class="form-control" name="about_page_offer_content" rows="5">'.$about_page_offer_content.'</textarea>';
										echo '</div>';
									?>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#schedulePage">Schedule Page</a>
								</h4>
							</div>
							<div id="schedulePage" class="panel-collapse collapse">
								<div class="panel-body">
									<?php 
										$schedule_page_title = $schedulePageOptions['schedule_page_title']['value'];
										$schedule_page_sub_title = $schedulePageOptions['schedule_page_sub_title']['value'];
										$schedule_page_content = $schedulePageOptions['schedule_page_content']['value'];
										$schedule_page_table_content = $schedulePageOptions['schedule_page_table_content']['value'];
										
										echo '<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">';
											echo '<label class="control-label" for="themeoption-schedule_page_title">Title</label>';
											echo '<input type="text" id="themeoption-schedule_page_title" class="form-control" name="schedule_page_title" value="'.$schedule_page_title.'"/>';
										echo '</div>';
										echo '<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">';
											echo '<label class="control-label" for="themeoption-schedule_page_sub_title">Sub Title</label>';
											echo '<input type="text" id="themeoption-schedule_page_sub_title" class="form-control" name="schedule_page_sub_title" value="'.$schedule_page_sub_title.'"/>';
										echo '</div>';
										echo '<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">';
											echo '<label class="control-label" for="themeoption-schedule_page_content">Content</label>';
											echo '<textarea id="themeoption-schedule_page_content" class="form-control" name="schedule_page_content" rows="5">'.$schedule_page_content.'</textarea>';
										echo '</div>';
										echo '<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">';
											echo '<label class="control-label" for="themeoption-schedule_page_table_content">Timetable Content</label>';
											echo '<textarea id="themeoption-schedule_page_table_content" class="form-control" name="schedule_page_table_content" rows="5">'.$schedule_page_table_content.'</textarea>';
										echo '</div>';
									?>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#contactPage">Contact Page</a>
								</h4>
							</div>
							<div id="contactPage" class="panel-collapse collapse">
								<div class="panel-body">
									<?php 
										$contact_map_address = $contactPageOptions['contact_map_address']['value'];
										$contact_phone = $contactPageOptions['contact_phone']['value'];
										$contact_email = $contactPageOptions['contact_email']['value'];
												
										echo '<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12">';
											echo '<label class="control-label" for="themeoption-contact_map_address">Contact Page Map Address/Coordinates</label>';
											echo '<input type="text" id="themeoption-contact_map_address" class="form-control" name="contact_map_address" value="'.$contact_map_address.'"/>';
										echo '</div>';
										echo '<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12">';
											echo '<label class="control-label" for="themeoption-contact_phone">Phone</label>';
											echo '<input type="text" id="themeoption-contact_phone" class="form-control" name="contact_phone" value="'.$contact_phone.'">';
										echo '</div>';
										echo '<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12">';
											echo '<label class="control-label" for="themeoption-contact_email">Email</label>';
											echo '<input type="text" id="themeoption-contact_email" class="form-control" name="contact_email" value="'.$contact_email.'">';
										echo '</div>';
									?>
								</div>
							</div>
						</div>
						<div class="form-group mt10">
							<button type="submit" class="btn btn-success">Save</button>
						</div>
					</form>
				</div>
	</div>
</div>