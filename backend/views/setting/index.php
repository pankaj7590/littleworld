<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Setting;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">

    <p>
        <?= Html::a('Add Setting', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'setting_group',
				'filter' => Setting::$groups,
				'value' => function($data){
					return ($data->setting_group?Setting::$groups[$data->setting_group]:null);
				},
			],
            'name',
            'label',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
