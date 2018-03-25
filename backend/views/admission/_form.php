<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Admission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admission-form">

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'fee')->textInput() ?>

    <?= $form->field($model, 'is_paid')->checkbox() ?>

</div>
