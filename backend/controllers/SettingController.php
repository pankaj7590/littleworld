<?php

namespace backend\controllers;

use Yii;
use common\models\Setting;
use common\models\SettingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\MediaTypes;
use common\components\MediaUploader;
use yii\web\UploadedFile;

/**
 * SettingController implements the CRUD actions for Setting model.
 */
class SettingController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Setting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SettingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Setting model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Setting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Setting();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Setting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Lists all Theme Setting models.
     * @return mixed
     */
    public function actionThemeOptions()
    {
        $searchModel = new SettingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		//header options
		$headerOptionModels = Setting::find()->where(['setting_group' => Setting::GROUP_HEADER])->all();
		$headerOptions = [];
		foreach($headerOptionModels as $model){
			$headerOptions[$model->name] = $model;
		}
		//footer options
		$footerOptionModels = Setting::find()->where(['setting_group' => Setting::GROUP_FOOTER])->all();
		$footerOptions = [];
		foreach($footerOptionModels as $model){
			$footerOptions[$model->name] = $model;
		}
		// echo "<pre>";print_r($footerOptions);exit;
		//home page options
		$homePageOptionModels = Setting::find()->where(['setting_group' => Setting::GROUP_HOME_PAGE])->all();
		$homePageOptions = [];
		foreach($homePageOptionModels as $model){
			$homePageOptions[$model->name] = $model;
		}
		//home page options
		$contactPageOptionModels = Setting::find()->where(['setting_group' => Setting::GROUP_CONTACT_PAGE])->all();
		$contactPageOptions = [];
		foreach($contactPageOptionModels as $model){
			$contactPageOptions[$model->name] = $model;
		}
		//about page options
		$aboutPageOptionModels = Setting::find()->where(['setting_group' => Setting::GROUP_ABOUT_PAGE])->all();
		$aboutPageOptions = [];
		foreach($aboutPageOptionModels as $model){
			$aboutPageOptions[$model->name] = $model;
		}
		//schedule page options
		$schedulePageOptionModels = Setting::find()->where(['setting_group' => Setting::GROUP_SCHEDULE_PAGE])->all();
		$schedulePageOptions = [];
		foreach($schedulePageOptionModels as $model){
			$schedulePageOptions[$model->name] = $model;
		}
		if(Yii::$app->request->post()){
			$sent_options = Yii::$app->request->post();
			// echo "<pre>";print_r($sent_options);exit;
			//SAVING HOME PAGE SLIDER SLIDES
			$slider_images = UploadedFile::getInstancesByName('main_slider_images');
			$sliderimages = [];
			foreach ($slider_images as $k => $v) {
				if ($v != null && !$v->getHasError()) {
					$type = MediaTypes::THEME_OPTION;
					$mediaDetails = MediaUploader::uploadFiles($v, $type);
					if ($mediaDetails) {
						$sliderimages[] = $mediaDetails['media_id'];
					}
				}
			}
			if(count($sliderimages)){
				$main_slider_images_model = Setting::findOne(['name' => 'main_slider_images']);
				if(!$main_slider_images_model->default_value){
					$main_slider_images_model->default_value = json_encode($sliderimages);
				}
				$main_slider_images_model->value = json_encode($sliderimages);
				$main_slider_images_model->save();
			}
			
			$home_page_title = $sent_options['home_page_title'];
			$home_page_title_model = Setting::findOne(['name' => 'home_page_title']);
			if($home_page_title_model){
				if(!$home_page_title_model->default_value){
					$home_page_title_model->default_value = $home_page_title;
				}
				$home_page_title_model->value = $home_page_title;
				$home_page_title_model->save();
			}
			$home_page_content = $sent_options['home_page_content'];
			$home_page_content = Setting::findOne(['name' => 'home_page_content']);
			if($home_page_content_model){
				if(!$home_page_content_model->default_value){
					$home_page_content_model->default_value = $home_page_content;
				}
				$home_page_content_model->value = $home_page_content;
				$home_page_content_model->save();
			}
			
			//SAVING HEADER OPTIONS
			$file = UploadedFile::getInstanceByName('menu_bar_logo');
			if ($file != null && !$file->getHasError()) {
				$type = MediaTypes::THEME_OPTION;
				$mediaDetails = MediaUploader::uploadFiles($file, $type);
				if ($mediaDetails) {
					$menu_bar_logo_model = Setting::findOne(['name' => 'menu_bar_logo']);
					if(!$menu_bar_logo_model->default_value){
						$menu_bar_logo_model->default_value = strval($mediaDetails['media_id']);
					}
					$menu_bar_logo_model->value = strval($mediaDetails['media_id']);
					$menu_bar_logo_model->save();
				}
			}
			
			$twitter = $sent_options['twitter'];
			$twitter_model = Setting::findOne(['name' => 'twitter']);
			if($twitter_model){
				if(!$twitter_model->default_value){
					$twitter_model->default_value = $twitter;
				}
				$twitter_model->value = $twitter;
				$twitter_model->save();
			}
			$gplus = $sent_options['gplus'];
			$gplus_model = Setting::findOne(['name' => 'gplus']);
			if($gplus_model){
				if(!$gplus_model->default_value){
					$gplus_model->default_value = $gplus;
				}
				$gplus_model->value = $gplus;
				$gplus_model->save();
			}
			$instagram = $sent_options['instagram'];
			$instagram_model = Setting::findOne(['name' => 'instagram']);
			if($instagram_model){
				if(!$instagram_model->default_value){
					$instagram_model->default_value = $instagram;
				}
				$instagram_model->value = $instagram;
				$instagram_model->save();
			}
			$facebook = $sent_options['facebook'];
			$facebook_model = Setting::findOne(['name' => 'facebook']);
			if($facebook_model){
				if(!$facebook_model->default_value){
					$facebook_model->default_value = $facebook;
				}
				$facebook_model->value = $facebook;
				$facebook_model->save();
			}
			$pinterest = $sent_options['pinterest'];
			$pinterest_model = Setting::findOne(['name' => 'pinterest']);
			if($pinterest_model){
				if(!$pinterest_model->default_value){
					$pinterest_model->default_value = $pinterest;
				}
				$pinterest_model->value = $pinterest;
				$pinterest_model->save();
			}
			
			//SAVING FOOTER OPTIONS
			$footer_developer = $sent_options['footer_developer'];
			$footer_developer_model = Setting::findOne(['name' => 'footer_developer']);
			if($footer_developer_model){
				if(!$footer_developer_model->default_value){
					$footer_developer_model->default_value = $footer_developer;
				}
				$footer_developer_model->value = $footer_developer;
				$footer_developer_model->save();
			}
			$footer_developer_link = $sent_options['footer_developer_link'];
			$footer_developer_link_model = Setting::findOne(['name' => 'footer_developer_link']);
			if($footer_developer_link_model){
				if(!$footer_developer_link_model->default_value){
					$footer_developer_link_model->default_value = $footer_developer_link;
				}
				$footer_developer_link_model->value = $footer_developer_link;
				$footer_developer_link_model->save();
			}
			$footer_copyright = $sent_options['footer_copyright'];
			$footer_copyright_model = Setting::findOne(['name' => 'footer_copyright']);
			if($footer_copyright_model){
				if(!$footer_copyright_model->default_value){
					$footer_copyright_model->default_value = $footer_copyright;
				}
				$footer_copyright_model->value = $footer_copyright;
				$footer_copyright_model->save();
			}
			
			//CONTACT PAGE OPTIONS
			$contact_map_address = $sent_options['contact_map_address'];
			$contact_map_address_model = Setting::findOne(['name' => 'contact_map_address']);
			if($contact_map_address_model){
				if(!$contact_map_address_model->default_value){
					$contact_map_address_model->default_value = $contact_map_address;
				}
				$contact_map_address_model->value = $contact_map_address;
				$contact_map_address_model->save();
			}
			$contact_phone = $sent_options['contact_phone'];
			$contact_phone_model = Setting::findOne(['name' => 'contact_phone']);
			if($contact_phone_model){
				if(!$contact_phone_model->default_value){
					$contact_phone_model->default_value = $contact_phone;
				}
				$contact_phone_model->value = $contact_phone;
				$contact_phone_model->save();
			}
			$contact_email = $sent_options['contact_email'];
			$contact_email_model = Setting::findOne(['name' => 'contact_email']);
			if($contact_email_model){
				if(!$contact_email_model->default_value){
					$contact_email_model->default_value = $contact_email;
				}
				$contact_email_model->value = $contact_email;
				$contact_email_model->save();
			}
			
			//SAVING SCHEDULE PAGE OPTIONS
			$schedule_page_title = $sent_options['schedule_page_title'];
			$schedule_page_title_model = Setting::findOne(['name' => 'schedule_page_title']);
			if($schedule_page_title_model){
				if(!$schedule_page_title_model->default_value){
					$schedule_page_title_model->default_value = $schedule_page_title;
				}
				$schedule_page_title_model->value = $schedule_page_title;
				$schedule_page_title_model->save();
			}
			$schedule_page_sub_title = $sent_options['schedule_page_sub_title'];
			$schedule_page_sub_title_model = Setting::findOne(['name' => 'schedule_page_sub_title']);
			if($schedule_page_sub_title_model){
				if(!$schedule_page_sub_title_model->default_value){
					$schedule_page_sub_title_model->default_value = $schedule_page_sub_title;
				}
				$schedule_page_sub_title_model->value = $schedule_page_sub_title;
				$schedule_page_sub_title_model->save();
			}
			$schedule_page_content = $sent_options['schedule_page_content'];
			$schedule_page_content_model = Setting::findOne(['name' => 'schedule_page_content']);
			if($schedule_page_content_model){
				if(!$schedule_page_content_model->default_value){
					$schedule_page_content_model->default_value = $schedule_page_content;
				}
				$schedule_page_content_model->value = $schedule_page_content;
				$schedule_page_content_model->save();
			}
			$schedule_page_table_content = $sent_options['schedule_page_table_content'];
			$schedule_page_table_content_model = Setting::findOne(['name' => 'schedule_page_table_content']);
			if($schedule_page_table_content_model){
				if(!$schedule_page_table_content_model->default_value){
					$schedule_page_table_content_model->default_value = $schedule_page_table_content;
				}
				$schedule_page_table_content_model->value = $schedule_page_table_content;
				$schedule_page_table_content_model->save();
			}
			
			//SAVING ABOUT PAGE OPTIONS
			$about_page_title = $sent_options['about_page_title'];
			$about_page_title_model = Setting::findOne(['name' => 'about_page_title']);
			if($about_page_title_model){
				if(!$about_page_title_model->default_value){
					$about_page_title_model->default_value = $about_page_title;
				}
				$about_page_title_model->value = $about_page_title;
				$about_page_title_model->save();
			}
			$about_page_content = $sent_options['about_page_content'];
			$about_page_content_model = Setting::findOne(['name' => 'about_page_content']);
			if($about_page_content_model){
				if(!$about_page_content_model->default_value){
					$about_page_content_model->default_value = $about_page_content;
				}
				$about_page_content_model->value = $about_page_content;
				$about_page_content_model->save();
			}
			$about_page_offer_title = $sent_options['about_page_offer_title'];
			$about_page_offer_title_model = Setting::findOne(['name' => 'about_page_offer_title']);
			if($about_page_offer_title_model){
				if(!$about_page_offer_title_model->default_value){
					$about_page_offer_title_model->default_value = $about_page_offer_title;
				}
				$about_page_offer_title_model->value = $about_page_offer_title;
				$about_page_offer_title_model->save();
			}
			$about_page_offer_content = $sent_options['about_page_offer_content'];
			$about_page_offer_content_model = Setting::findOne(['name' => 'about_page_offer_content']);
			if($about_page_offer_content_model){
				if(!$about_page_offer_content_model->default_value){
					$about_page_offer_content_model->default_value = $about_page_offer_content;
				}
				$about_page_offer_content_model->value = $about_page_offer_content;
				$about_page_offer_content_model->save();
			}
			
			return $this->redirect(['theme-options']);
		}

        return $this->render('theme_options', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'headerOptions' => $headerOptions,
            'footerOptions' => $footerOptions,
            'homePageOptions' => $homePageOptions,
            'contactPageOptions' => $contactPageOptions,
            'aboutPageOptions' => $aboutPageOptions,
            'schedulePageOptions' => $schedulePageOptions,
        ]);
    }

    /**
     * Deletes an existing Setting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Setting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Setting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Setting::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
