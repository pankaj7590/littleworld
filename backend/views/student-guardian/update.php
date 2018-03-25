<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StudentGuardian */

$this->title = 'Update Student Guardian: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Student Guardians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-guardian-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
