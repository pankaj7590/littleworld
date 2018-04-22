<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;
use common\models\UserSearch;
use yii\web\NotFoundHttpException;

class StaffController extends Controller
{
	public function actionIndex()
	{
		$searchModel = new UserSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);	
	}
	
	public function actionView($id)
	{
		$model = $this->findModel($id);
		$staff = User::find()->orderBy('created_at desc')->all();
		return $this->render('view', [
			'model' => $model,
			'staff' => $staff,
		]);	
	}
	
	public function findModel($id){
		if($model = User::findOne($id)){
			return $model;
		}
		throw new NotFoundHttpException('Requested staff does not exist.');
	}
}
?>