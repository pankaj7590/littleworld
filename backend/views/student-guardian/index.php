<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StudentGuardianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guardians';
$this->params['breadcrumbs'][] = ['label' => $searchModel->student->name, 'url' => ['student/view', 'id' => $searchModel->student_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-guardian-index">

    <p>
        <?= Html::a('Add Guardian', ['guardian/create', 'id' => $searchModel->student_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'guardian_id',
				'value' => function($data){
					return ($data->guardian->name);
				},
			],
            // 'guardian_relation',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
