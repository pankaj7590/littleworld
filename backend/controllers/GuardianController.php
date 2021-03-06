<?php

namespace backend\controllers;

use Yii;
use common\models\Student;
use common\models\StudentGuardian;
use common\models\Guardian;
use common\models\GuardianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * GuardianController implements the CRUD actions for Guardian model.
 */
class GuardianController extends Controller
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
     * Lists all Guardian models.
     * @return mixed
     */
    public function actionIndex($id=NULL)
    {
        $searchModel = new GuardianSearch();
		$student = null;
		if($id){
			$student = $this->findStudent($id);
			$searchModel->student_id = $student->id;
		}
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'student' => $student,
        ]);
    }

    /**
     * Displays a single Guardian model.
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
     * Creates a new Guardian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
		$student = $this->findStudent($id);
        $model = new Guardian();
		$model->student_id = $student->id;

        if ($model->load(Yii::$app->request->post())){
			$model->setPassword($model->password);
			$model->generateAuthKey();
			if($model->save()) {
				$studentGuardian = new StudentGuardian();
				$studentGuardian->student_id = $student->id;
				$studentGuardian->guardian_id = $model->id;
				$studentGuardian->guardian_relation = $model->guardian_relation;
				$studentGuardian->save();
			
				return $this->redirect(['view', 'id' => $model->id]);
			}else{
				Yii::$app->session->setFlash('error', json_encode($model->getErrors()));
			}
        }

        return $this->render('create', [
            'model' => $model,
            'student' => $student,
        ]);
    }

    /**
     * Updates an existing Guardian model.
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
     * Deletes an existing Guardian model.
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
     * Finds the Guardian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Guardian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Guardian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Guardian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findStudent($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested student does not exist.');
    }
}
