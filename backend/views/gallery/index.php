<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Gallery;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Galleries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">

    <p>
        <?= Html::a('Add Gallery', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'description:ntext',
            'type',
			[
				'attribute' => 'status',
				'value' => function($data){
					return ($data->status?Gallery::$statuses[$data->status]:NULL);
				},
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
