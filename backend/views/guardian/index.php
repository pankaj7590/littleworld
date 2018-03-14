<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GuardianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guardians';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guardian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Guardian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'address:ntext',
            'dob',
            'photo',
            //'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'email:email',
            //'phone',
            //'status',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
