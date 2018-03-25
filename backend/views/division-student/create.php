<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DivisionStudent */

$this->title = 'Add Students';
$this->params['breadcrumbs'][] = ['label' => 'Divisions', 'url' => ['division/index']];
$this->params['breadcrumbs'][] = ['label' => $model->division->name, 'url' => ['division/view', 'id' => $model->division_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="division-student-create">

    <?= $this->render('_form', [
        'model' => $model,
        'students' => $students,
    ]) ?>

</div>
