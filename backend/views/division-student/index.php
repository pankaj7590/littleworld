<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DivisionStudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Division Students';
$this->params['breadcrumbs'][] = ['label' => 'Divisions', 'url' => ['division/index']];
$this->params['breadcrumbs'][] = ['label' => $searchModel->division->name, 'url' => ['division/view', 'id' => $searchModel->division_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="division-student-index">

    <p>
        <?= Html::a('Add Students', ['create', 'id' => $searchModel->division_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'student_id',
				'value' => function($data){
					return ($data->student?$data->student->name:null);
				},
			],

            [
				'class' => 'yii\grid\ActionColumn',
				'buttons' => [
					'view' => function($key, $model, $url){
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['student/view', 'id' => $model->student_id]);
					},
					'update' => function($key, $model, $url){
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['student/update', 'id' => $model->student_id]);
					},
				],
			],
        ],
    ]); ?>
</div>
