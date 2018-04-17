<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Media';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'file_name',
				'filter' => false,
				'value' => function($data){
					$fileName = ($data->file_name?$data->file_name:"");
					return \common\components\MediaHelper::getImageUrl($fileName);
				},
				'format' => ['image', ['width' => '100']],
			],
            'alt',
            'file_type',
            'file_size',

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {delete}',
			],
        ],
    ]); ?>
</div>
