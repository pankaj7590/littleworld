<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Guardian */

$this->title = 'Update Guardian: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Guardians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="guardian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
