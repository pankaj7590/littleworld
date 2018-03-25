<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Guardian */

$this->title = 'Add Guardian';
$this->params['breadcrumbs'][] = ['label' => $student->name, 'url' => ['student/view', 'id' => $model->student_id]];
$this->params['breadcrumbs'][] = ['label' => 'Guardians', 'url' => ['student-guardian/index', 'id' => $model->student_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guardian-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
