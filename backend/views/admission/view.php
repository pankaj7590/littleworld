<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Admission */

$this->title = ($model->student?$model->student->name:$model->id);
$this->params['breadcrumbs'][] = ['label' => 'Admissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admission-view">

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
