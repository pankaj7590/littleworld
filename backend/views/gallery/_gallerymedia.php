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
				'buttons' => [
				],
			],
        ],
    ]); ?>
</div>
