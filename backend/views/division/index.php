<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DivisionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Divisions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="division-index">
    <p>
        <?= Html::a('Add Division', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'year',
            'name',

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update} {delete} {students}',
				'buttons' => [
					'students' => function($key, $model, $url){
						return Html::a('<span class="glyphicon glyphicon-user"></span>', ['division-student/index', 'id' => $model->id]);
					}
				],
			],
        ],
    ]); ?>
</div>
