<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\UserSearch;
use common\models\NewsEvent;
use common\models\NewsEventSearch;
use common\models\Admission;
use common\models\Student;
use common\models\Guardian;
use common\models\StudentGuardian;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'admission', 'profile'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'admission', 'profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsEventSearch();
        $searchModel->type = NewsEvent::TYPE_EVENT;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder'=>'news_event_date DESC']);
        $dataProvider->pagination->pageSize = 2;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays schedule page.
     *
     * @return mixed
     */
    public function actionSchedule()
    {
        $searchModel = new NewsEventSearch();
        $searchModel->type = NewsEvent::TYPE_EVENT;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder'=>'news_event_date DESC']);
        $dataProvider->pagination->pageSize = 4;
		
        return $this->render('schedule', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays schedule page.
     *
     * @return mixed
     */
    public function actionGallery()
    {
        return $this->render('gallery');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('about', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
	
	public function actionAdmission(){
		$model = new Admission();
		$model->detachBehavior('blameable');
        $studentModel = new Student();
		$studentModel->detachBehavior('blameable');
		$guardianModel = $this->findGuardian(Yii::$app->user->id);
		$guardianModel->detachBehavior('blameable');
		$transaction = Yii::$app->db->beginTransaction();
		try{
			if($studentModel->load(Yii::$app->request->post())){
				if($studentModel->save()){
					if($guardianModel->load(Yii::$app->request->post())){
						if($guardianModel->create_new){
							$guardianModel = new Guardian();
							$guardianModel->load(Yii::$app->request->post());
							$guardianModel->generateAuthKey();
							if($guardianModel->password){
								$guardianModel->setPassword($guardianModel->password);
							}
							$guardianModel->generateAuthKey();
							$guardianModel->detachBehavior('blameable');
						}
						if($guardianModel->save()){
							$studentGuardian = new StudentGuardian();
							$studentGuardian->student_id = $studentModel->id;
							$studentGuardian->guardian_id = $guardianModel->id;
							$studentGuardian->guardian_relation = $guardianModel->guardian_relation;
							$studentGuardian->detachBehavior('blameable');
							if(!$studentGuardian->save()){
								Yii::$app->session->setFlash('error', json_encode($studentGuardian->getErrors()));
								// throw new ServerErrorHttpException('Student guardian not saved. Please try again.');
							}
						}else{
							Yii::$app->session->setFlash('error', json_encode($guardianModel->getErrors()));
							// throw new ServerErrorHttpException('Guardian not saved. Please try again.');
						}
						$model->student_id = $studentModel->id;
						$model->year = date('Y');
						if($model->save()) {
							$transaction->commit();
							return $this->redirect(['student/index']);
						}else{
							Yii::$app->session->setFlash('error', json_encode($model->getErrors()));
							// throw new ServerErrorHttpException('Guardian not saved. Please try again.');
						}
					}
				}else{
					Yii::$app->session->setFlash('error', json_encode($studentModel->getErrors()));
					// throw new ServerErrorHttpException('Student not saved. Please try again.');
				}
				$studentModel->dob = date('Y-m-d', $studentModel->dob);
				$guardianModel->dob = date('Y-m-d', $guardianModel->dob);
			}
		}catch(Exception $e){
			$transaction->rollBack();
			throw new ServerErrorHttpException('Something went wrong. Please try again.');
		}

        return $this->render('admission', [
            'model' => $model,
            'studentModel' => $studentModel,
            'guardianModel' => $guardianModel,
        ]);
	}
	
	public function actionProfile(){
		$guardianModel = $this->findGuardian(Yii::$app->user->id);
		$guardianModel->detachBehavior('blameable');
					
		if($guardianModel->load(Yii::$app->request->post()) && $guardianModel->save()){
			return $this->redirect(['profile']);
		}
		return $this->render('profile',[
            'model' => $guardianModel,
        ]);
	}

    /**
     * Finds the Guardian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admission the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findGuardian($id)
    {
        if (($model = Guardian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested guardian record does not exist.');
    }
}
