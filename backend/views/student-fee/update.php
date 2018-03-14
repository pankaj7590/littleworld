<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StudentFee */

$this->title = 'Update Student Fee: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Student Fees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-fee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
