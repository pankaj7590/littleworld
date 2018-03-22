<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GalleryMediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gallery Media';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-media-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'media_id',
				'filter' => false,
				'value' => function($data){
					$fileName = ($data->media?$data->media->file_name:"");
					return \common\components\MediaHelper::getImageUrl($fileName);
				},
				'format' => ['image', ['width' => '100']],
			],
            [
				'attribute' => 'updated_by',
				'value' => function($data){
					return ($data->updatedBy?$data->updatedBy->name:NULL);
				},
			],
            'updated_at:datetime',

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {delete}',
				'buttons' => [
					'view' => function($key, $model, $url){
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['media/view', 'id' => $model->media_id]);
					},
					'delete' => function($key, $model, $url){
						return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['media/delete', 'id' => $model->media_id], ['data' => ['method' => 'post', 'confirm' => 'Are you sure you want to delete this picture from gallery?']]);
					},
				],
			],
        ],
    ]); ?>
</div>
