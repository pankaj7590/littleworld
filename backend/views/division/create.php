<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Division */

$this->title = 'Add Division';
$this->params['breadcrumbs'][] = ['label' => 'Divisions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="division-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
