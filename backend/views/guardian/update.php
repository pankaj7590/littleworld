<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Guardian */

$this->title = 'Update Guardian: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Guardians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="guardian-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
