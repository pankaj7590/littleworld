<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>
	<?= $form->field($model, 'photoPictureFile', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->fileInput() ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'name', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['maxlength' => true]) ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'address', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textarea(['rows' => 6]) ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'dob', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['type' => 'date', 'max' => date('Y-m-d')]); ?>
	<strong class="clear"></strong>