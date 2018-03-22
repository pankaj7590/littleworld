<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Fee;

/* @var $this yii\web\View */
/* @var $model common\models\Fee */
$title = '';
if($model->year){
	$title .= $model->year.'-';
}
if($model->type){
	$title .= Fee::$types[$model->type].'-';
}
if($model->year){
	$title .= $model->amount;
}
$this->title = trim($title,'-');
$this->params['breadcrumbs'][] = ['label' => 'Fees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-view">

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
            'year',
            [
				'attribute' => 'type',
				'value' => function($data){
					return ($data->type?Fee::$types[$data->type]:NULL);
				},
			],
            'amount',
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
