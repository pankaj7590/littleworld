<?php

namespace backend\controllers;

use Yii;
use common\models\Division;
use common\models\Student;
use common\models\DivisionStudent;
use common\models\DivisionStudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * DivisionStudentController implements the CRUD actions for DivisionStudent model.
 */
class DivisionStudentController extends Controller
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
     * Lists all DivisionStudent models.
     * @return mixed
     */
    public function actionIndex($id)
    {
		$divisionModel = $this->findDivision($id);
        $searchModel = new DivisionStudentSearch();
        $searchModel->division_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DivisionStudent model.
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
     * Creates a new DivisionStudent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
		$divisionModel = $this->findDivision($id);
        $model = new DivisionStudent();
		$model->division_id = $id;
		
		$alreadyAddedModels = $divisionModel->divisionStudents;
		$alreadyAdded = [];
		foreach($alreadyAddedModels as $alreadyAddedModel){
			$alreadyAdded[$alreadyAddedModel->student_id] = $alreadyAddedModel->student_id;
		}
		
		
		$studentModels = Student::find()->joinWith('admissions')->where(['year' => $model->division->year])->andWhere(['not in', 'student.id', $alreadyAdded])->all();
		$students = [];
		foreach($studentModels as $student){
			$students[$student->id] = $student->name;
		}
		
        if ($model->load(Yii::$app->request->post())){
			$transaction = Yii::$app->db->beginTransaction();
			try{
				foreach($model->student_id as $s){
					$divisionStudent = new DivisionStudent();
					$divisionStudent->division_id = $divisionModel->id;
					$divisionStudent->student_id = $s;
					if(!$divisionStudent->save()) {
						Yii::$app->session->setFlash('error', json_encode($divisionStudent->getErrors()));
						throw new ServerErrorHttpException('Student not saved.');
					}
				}
				$transaction->commit();
			}catch(Exception $e){
				$transaction->rollBack();
				throw new ServerErrorHttpException('Something went wrong. Please try again.');
			}
            return $this->redirect(['index', 'id' => $divisionModel->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'students' => $students,
        ]);
    }

    /**
     * Updates an existing DivisionStudent model.
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
     * Deletes an existing DivisionStudent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		$model = $this->findModel($id);
		$model->delete();

        return $this->redirect(['index', 'id' => $model->division_id]);
    }

    /**
     * Finds the DivisionStudent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DivisionStudent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DivisionStudent::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Division model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DivisionStudent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findDivision($id)
    {
        if (($model = Division::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested division does not exist.');
    }
}
