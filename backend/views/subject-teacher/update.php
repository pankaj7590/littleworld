<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SubjectTeacher */

$this->title = 'Update Subject Teacher: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Subject Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subject-teacher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
