<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\NewsEvent;

/* @var $this yii\web\View */
/* @var $model common\models\NewsEvent */

$this->title = $model->title;
switch($model->type){
	case NewsEvent::TYPE_EVENT:
		$type = 'Event';
		$label = 'Events';
		$url = ['event-index'];
		break;
	default:
		$type = 'News';
		$label = 'News';
		$url = ['index'];
		break;
}
$this->params['breadcrumbs'][] = ['label' => $label, 'url' => $url];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-event-view">
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
				'attribute' => 'photoPictureFile',
				'filter' => false,
				'value' => function($data){
					$fileName = ($data->photoPicture?$data->photoPicture->file_name:"");
					return \common\components\MediaHelper::getImageUrl($fileName);
				},
				'format' => ['image', ['width' => '100']],
			],
            'title',
            'content:ntext',
            'news_event_date',
            'place:ntext',
            // 'status',
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
