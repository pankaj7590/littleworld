<?php

use yii\helpers\Html;
use common\models\Fee;

/* @var $this yii\web\View */
/* @var $model common\models\Fee */

$title = '';
if($model->year){
	$title .= $model->year.'-';
}
if($model->type){
	$title .= Fee::$types[$model->type].'-';
}
if($model->year){
	$title .= $model->amount;
}
$this->title = 'Update Fee: '.trim($title,'-');
$this->params['breadcrumbs'][] = ['label' => 'Fees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fee-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
