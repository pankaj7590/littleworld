<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Exam;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-index">
    <p>
        <?= Html::a('Add Exam', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'year',
			[
				'attribute' => 'type',
				'value' => function($data){
					return ($data->type?Exam::$types[$data->type]:NULL);
				},
			],
            'scheduled_date',
			[
				'attribute' => 'status',
				'value' => function($data){
					return ($data->status?Exam::$statuses[$data->status]:NULL);
				},
			],

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update} {delete} {subjects} {marks}',
				'buttons' => [
					'subjects' => function($key, $model, $url){
						return Html::a('<span class="glyphicon glyphicon-list"></span>', ['exam-subject/index', 'id' => $model->id], ['title' => 'Subjects']);
					},
					'marks' => function($key, $model, $url){
						return Html::a('<span class="glyphicon glyphicon-edit"></span>', ['exam-student-subject/index', 'id' => $model->id], ['title' => 'Marks']);
					},
				],
			],
        ],
    ]); ?>
</div>
