<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Exam;

/* @var $this yii\web\View */
/* @var $model common\models\Exam */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Exams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'year',
            [
				'attribute' => 'type',
				'value' => function($data){
					return ($data->type?Exam::$types[$data->type]:NULL);
				},
			],
            'scheduled_date:datetime',
            [
				'attribute' => 'status',
				'value' => function($data){
					return ($data->status?Exam::$statuses[$data->status]:NULL);
				},
			],
            [
				'attribute' => 'created_by',
				'value' => function($data){
					return ($data->createdBy?$data->createdBy->name:NULL);
				},
			],
            [
				'attribute' => 'updated_by',
				'value' => function($data){
					return ($data->updatedBy?$data->updatedBy->name:NULL);
				},
			],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
