<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Admission;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdmissionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admission-index">
    <p>
        <?= Html::a('Add Admission', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
				'attribute' => 'student_id',
				'value' => function($data){
					return ($data->student?$data->student->name:NULL);
				},
			],
            'year',
            'fee',
            [
				'attribute' => 'is_paid',
				'value' => function($data){
					return ($data->is_paid?'Yes':'No');
				},
			],
            [
				'attribute' => 'status',
				'filter' => Admission::$statuses,
				'value' => function($data){
					return ($data->status?Admission::$statuses[$data->status]:null);
				},
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
