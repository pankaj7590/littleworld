<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Fee */

$this->title = 'Add Fee';
$this->params['breadcrumbs'][] = ['label' => 'Fees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
