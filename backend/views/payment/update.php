<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Payment */

$this->title = 'Update Payment: '.($model->guardian?$model->guardian->name:NULL);
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => ($model->guardian?$model->guardian->name:NULL), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="payment-update">

    <?= $this->render('_form', [
        'model' => $model,
		'guardians' => $guardians,
    ]) ?>

</div>
