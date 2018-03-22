<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Exam */

$this->title = 'Update Exam: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Exams', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exam-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
