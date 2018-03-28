<?php

namespace backend\controllers;

use Yii;
use common\models\Exam;
use common\models\Subject;
use common\models\ExamSubject;
use common\models\ExamSubjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ExamSubjectController implements the CRUD actions for ExamSubject model.
 */
class ExamSubjectController extends Controller
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
     * Lists all ExamSubject models.
     * @return mixed
     */
    public function actionIndex($id)
    {
		$examModel = $this->findExam($id);
        $searchModel = new ExamSubjectSearch();
		$searchModel->exam_id = $examModel->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'examModel' => $examModel,
        ]);
    }

    /**
     * Displays a single ExamSubject model.
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
     * Creates a new ExamSubject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
		$examModel = $this->findExam($id);
        $model = new ExamSubject();
		$model->exam_id = $examModel->id;
		
		$alreadyPresentSubjects = $examModel->examSubjects;
		$alreadyPresentSubjectsArr = [];
		foreach($alreadyPresentSubjects as $sub){
			$alreadyPresentSubjectsArr[$sub->id] = $sub->id;
		}
		
		$subjectModels = Subject::find()->where(['not in', 'id', $alreadyPresentSubjectsArr])->all();
		$subjects = [];
		foreach($subjectModels as $subject){
			$subjects[$subject->id] = $subject->name;
		}

        if ($model->load(Yii::$app->request->post())){
			foreach($model->subject_id as $subject){
				$es_model = new ExamSubject();
				$es_model->subject_id = $subject;
				$es_model->exam_id = $examModel->id;
				$es_model->marks = $model->marks;
				if(!$es_model->save()){
					Yii::$app->session->setFlash('error', json_encode($es_model->getErrors()));
					throw new ServerErrorHttpException('Exam subject not saved. Please try again.');
				}
			}
            return $this->redirect(['index', 'id' => $examModel->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'subjects' => $subjects,
        ]);
    }

    /**
     * Updates an existing ExamSubject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

		$subjects = [];
		$subjects[$model->subject_id] = $model->subject->name;
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->exam_id]);
        }
		
        return $this->render('update', [
            'model' => $model,
            'subjects' => $subjects,
        ]);
    }

    /**
     * Deletes an existing ExamSubject model.
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
     * Finds the ExamSubject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExamSubject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ExamSubject::findOne($id)) !== null) {
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
