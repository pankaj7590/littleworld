<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Admission */

$this->title = 'Add Admission';
$this->params['breadcrumbs'][] = ['label' => 'Admissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admission-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
