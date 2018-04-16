<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
if($guardian){
	$this->params['breadcrumbs'][] = ['label' => $guardian->name, 'url' => ['guardian/view', 'id' => $guardian->id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <p>
        <?= Html::a('Add Student', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'photo',
				'filter' => false,
				'value' => function($data){
					$fileName = ($data->photoPicture?$data->photoPicture->file_name:"");
					return \common\components\MediaHelper::getImageUrl($fileName);
				},
				'format' => ['image', ['width' => '100']],
			],
            'name',
            'address:ntext',
            'dob:date',

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update} {delete} {guardians} {fees}',
				'buttons' => [
					'guardians' => function($key, $model, $url){
						return Html::a('<span class="glyphicon glyphicon-user"></span>', ['guardian/index', 'id' => $model->id]);
					},
					'fees' => function($key, $model, $url){
						return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', ['student-fee/index', 'id' => $model->id]);
					},
				],
			],
        ],
    ]); ?>
</div>
