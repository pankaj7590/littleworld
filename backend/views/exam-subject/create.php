<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ExamSubject */

$this->title = 'Create Exam Subject';
$this->params['breadcrumbs'][] = ['label' => 'Exam Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
