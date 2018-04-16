<?php

namespace backend\controllers;

use Yii;
use common\models\Student;
use common\models\StudentFee;
use common\models\StudentGuardian;
use common\models\Guardian;
use common\models\AdmissionCheckForm;
use common\models\Admission;
use common\models\AdmissionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AdmissionController implements the CRUD actions for Admission model.
 */
class AdmissionController extends Controller
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
     * Lists all Admission models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdmissionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admission model.
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
     * Checks if guardian is already present or not.
     * If guardian is already present, the browser will be redirected to the 'create' page with Guardian model.
     * @return mixed
     */
    public function actionCheckGuardian()
    {
		$checkModel = new AdmissionCheckForm();
		if($checkModel->load(Yii::$app->request->post())){
			if($model = $checkModel->check()){
				Yii::$app->session->setFlash('success', 'Guardian is already present. Please enter student details.');
				return $this->redirect(['create', 'guardian_id' => $model->id]);
			}else{
				Yii::$app->session->setFlash('success', 'Guardian is not present. Please enter student and guardian details.');
				return $this->redirect(['create']);
			}
		}
		return $this->render('check-guardian', [
			'model' => $checkModel,
		]);
	}
	
    /**
     * Creates a new Admission model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($guardian_id = null)
    {
		
		$model = new Admission();
        $studentModel = new Student();
		if($guardian_id != null){
			$guardianModel = $this->findGuardian($guardian_id);
		}else{
			$guardianModel = new Guardian();
		}
		$transaction = Yii::$app->db->beginTransaction();
		try{
			if($studentModel->load(Yii::$app->request->post())){
				if($studentModel->save()){
					if($guardianModel->load(Yii::$app->request->post())){
						if($guardianModel->password){
							$guardianModel->setPassword($guardianModel->password);
							$guardianModel->generateAuthKey();
						}
						if($guardianModel->save()){
							$studentGuardian = new StudentGuardian();
							$studentGuardian->student_id = $studentModel->id;
							$studentGuardian->guardian_id = $guardianModel->id;
							$studentGuardian->guardian_relation = $guardianModel->guardian_relation;
							if(!$studentGuardian->save()){
								Yii::$app->session->setFlash('error', json_encode($studentGuardian->getErrors()));
								throw new ServerErrorHttpException('Student guardian not saved. Please try again.');
							}
						}else{
							Yii::$app->session->setFlash('error', json_encode($guardianModel->getErrors()));
							throw new ServerErrorHttpException('Guardian not saved. Please try again.');
						}
						$model->student_id = $studentModel->id;
						if ($model->load(Yii::$app->request->post()) && $model->save()) {
							$studentFee = new StudentFee();
							$studentFee->amount = $model->fee;
							$studentFee->student_id = $studentModel->id;
							$studentFee->is_paid = $model->is_paid;
							if(!$studentFee->save()){
								Yii::$app->session->setFlash('error', json_encode($studentFee->getErrors()));
							}
							$transaction->commit();
							return $this->redirect(['view', 'id' => $model->id]);
						}
					}
				}else{
					Yii::$app->session->setFlash('error', json_encode($studentModel->getErrors()));
					// throw new ServerErrorHttpException('Student not saved. Please try again.');
				}
			}
		}catch(Exception $e){
			$transaction->rollBack();
			throw new ServerErrorHttpException('Something went wrong. Please try again.');
		}

        return $this->render('create', [
            'model' => $model,
            'studentModel' => $studentModel,
            'guardianModel' => $guardianModel,
        ]);
    }

    /**
     * Updates an existing Admission model.
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
     * Deletes an existing Admission model.
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
     * Finds the Admission model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admission the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admission::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
