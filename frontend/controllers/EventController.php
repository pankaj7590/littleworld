<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\NewsEvent;
use common\models\NewsEventSearch;
use yii\web\NotFoundHttpException;

class EventController extends Controller
{
	public function actionIndex()
	{
		$searchModel = new NewsEventSearch();
		$searchModel->type = NewsEvent::TYPE_EVENT;
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);	
	}
	
	public function actionView($id)
	{
		$model = $this->findModel($id);
		$recentEvents = NewsEvent::find()->where(['type' => NewsEvent::TYPE_EVENT])->orderBy('created_at desc')->all();
		return $this->render('view', [
			'model' => $model,
			'recentEvents' => $recentEvents,
		]);	
	}
	
	public function findModel($id){
		if($model = NewsEvent::findOne($id)){
			return $model;
		}
		throw new NotFoundHttpException('Requested event does not exist.');
	}
}
?>