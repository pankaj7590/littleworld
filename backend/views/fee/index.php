<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Fee;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-index">
    <p>
        <?= Html::a('Add Fee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'year',
            [
				'attribute' => 'type',
				'value' => function($data){
					return ($data->type?Fee::$types[$data->type]:NULL);
				},
			],
            'amount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
