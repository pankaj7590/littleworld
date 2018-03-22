<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-index">

    <p>
        <?= Html::a('Add Payment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
			[
				'attribute' => 'fee_id',
				'value' => function($data){
					return ($data->fee?$data->fee->amount:NULL);
				},
			],
            'email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
