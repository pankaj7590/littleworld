<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExamSubjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subjects';
$this->params['breadcrumbs'][] = ['label' => 'Exams', 'url' => ['exam/index']];
$this->params['breadcrumbs'][] = ['label' => $examModel->name, 'url' => ['exam/view', 'id' => $examModel->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-subject-index">
    <p>
        <?= Html::a('Add Subjects', ['create', 'id' => $examModel->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'subject_id',
				'value' => function($data){
					return ($data->subject?$data->subject->name:null);
				},
			],
            'marks',

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update} {edit} {delete}',
				'buttons' => [
					'view' => function($key, $model, $url){
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['subject/view', 'id' => $model->subject_id]);
					},
					'update' => function($key, $model, $url){
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['subject/update', 'id' => $model->subject_id]);
					},
					'edit' => function($key, $model, $url){
						return Html::a('<span class="glyphicon glyphicon-edit"></span>', ['exam-subject/update', 'id' => $model->id]);
					},
				]
			],
        ],
    ]); ?>
</div>
