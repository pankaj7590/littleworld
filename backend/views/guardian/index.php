<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GuardianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guardians';
if($student){
	$this->params['breadcrumbs'][] = ['label' => $student->name, 'url' => ['student/view', 'id' => $student->id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guardian-index">

    <p>
        <?= Html::a('Add Guardian', ['create'], ['class' => 'btn btn-success']) ?>
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
            'dob',
            'email:email',
            'phone',

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update} {delete} {students}',
				'buttons' => [
					'students' => function($key, $model, $url){
						return Html::a('<span class="glyphicon glyphicon-user"></span>', ['student/index', 'id' => $model->id]);
					},
				],
			],
        ],
    ]); ?>
</div>
