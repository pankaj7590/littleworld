<?php

namespace backend\controllers;

use Yii;
use common\models\Exam;
use common\models\Student;
use common\models\ExamSubject;
use common\models\ExamStudent;
use common\models\ExamStudentSubject;
use common\models\ExamStudentSubjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ExamStudentSubjectController implements the CRUD actions for ExamStudentSubject model.
 */
class ExamStudentSubjectController extends Controller
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
     * Lists all ExamStudentSubject models.
     * @return mixed
     */
    public function actionIndex($id)
    {
		$examModel = $this->findExam($id);
        $searchModel = new ExamStudentSubjectSearch();
		$searchModel->exam_id = $examModel->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$students = Student::find()->joinWith('admissions')->where(['year' => $examModel->year])->all();

		if(Yii::$app->request->post()){
			$post = Yii::$app->request->post();
			$examSubjectStudents = $post['ExamStudentSubject'];
			$transaction = Yii::$app->db->beginTransaction();
			try{
				foreach($examSubjectStudents as $student => $exam_subjects){//iterates through students
					$studentModel = Student::findOne($student);
					if(!$studentModel){
						throw new NotFoundHttpException('Student not found.');
					}
					$examStudent = ExamStudent::findOne(['student_id' => $student, 'exam_id' => $examModel->id]);
					if(!$examStudent){
						$examStudent = new ExamStudent();
						$examStudent->student_id = $student;
						$examStudent->exam_id = $examModel->id;
						$examStudent->save();
					}
					foreach($exam_subjects as $exam_subject => $details){//iterates through exam subjects
						$examSubjectModel = ExamSubject::findOne($exam_subject);
						if(!$examSubjectModel){
							throw new NotFoundHttpException('Subject is not added in exam.');
						}
						$model = ExamStudentSubject::findOne(['exam_student_id' => $examStudent->id, 'exam_subject_id' => $exam_subject]);
						if(!$model){
							$model = new ExamStudentSubject();
							$model->exam_student_id = $examStudent->id;
							$model->exam_subject_id = $exam_subject;
							$model->exam_id = $examModel->id;
							$model->student_id = $student;
						}
						$model->marks = $details['marks'];
						$model->secured_marks = $details['secured_marks'];
						$model->grade = $details['grade'];
						$model->remarks = $details['remarks'];
						if(!$model->save()){
							Yii::$app->session->setFlash('error', json_encode($model->getErrors()));
							throw new ServerErrorHttpException('Marks not saved. Please try again.');
						}
					}
				}
				$transaction->commit();
				return $this->redirect(['index', 'id' => $id]);
			}catch(Exception $e){
				$transaction->rollBack();
				throw new ServerErrorHttpException('Something went wrong. Please try again.');
			}
		}
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'examModel' => $examModel,
            'students' => $students,
        ]);
    }

    /**
     * Displays a single ExamStudentSubject model.
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
     * Creates a new ExamStudentSubject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ExamStudentSubject();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ExamStudentSubject model.
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
     * Deletes an existing ExamStudentSubject model.
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
     * Finds the ExamStudentSubject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExamStudentSubject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ExamStudentSubject::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Exam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExamSubject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findExam($id)
    {
        if (($model = Exam::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested exam does not exist.');
    }
}
