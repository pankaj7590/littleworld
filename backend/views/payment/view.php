<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Payment;

/* @var $this yii\web\View */
/* @var $model common\models\Payment */

$this->title = ($model->guardian?$model->guardian->name:NULL);
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-view">

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
				'attribute' => 'guardian_id',
				'value' => function($data){
					return ($data->guardian?$data->guardian->name:NULL);
				},
			],
			[
				'attribute' => 'student_id',
				'value' => function($data){
					return ($data->student?$data->student->name:NULL);
				},
			],
            'email:email',
            'mobile',
            'amount',
            [
				'attribute' => 'status',
				'value' => function($data){
					return ($data->status?Payment::$statuses[$data->status]:NULL);
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
