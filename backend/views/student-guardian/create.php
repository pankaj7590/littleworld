<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\StudentGuardian */

$this->title = 'Create Student Guardian';
$this->params['breadcrumbs'][] = ['label' => 'Student Guardians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-guardian-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
