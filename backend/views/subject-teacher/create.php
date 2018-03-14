<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SubjectTeacher */

$this->title = 'Create Subject Teacher';
$this->params['breadcrumbs'][] = ['label' => 'Subject Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-teacher-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
