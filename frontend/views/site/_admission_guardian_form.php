<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\components\Relations;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Guardian */
/* @var $form yii\widgets\ActiveForm */
?>
	<?= $form->field($model, 'guardian_relation', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->dropdownList(Relations::$relations) ?>
	<strong class="clear"></strong>
	<?= $form->field($model, 'profilePictureFile', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->fileInput() ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'name', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['maxlength' => true]) ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'username', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['maxlength' => true]) ?>
	<strong class="clear"></strong>
	<?= $form->field($model, 'password', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->passwordInput() ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'email', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['maxlength' => true]) ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'phone', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['maxlength' => true]) ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'address', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textarea(['rows' => 6]) ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'dob', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['type' => 'date', 'max' => date('Y-m-d', (time()-(18*365*24*3600))), 'value' => date('Y-m-d', strtotime($model->dob))]); ?>
	<strong class="clear"></strong>
    <?= $form->field($model, 'create_new')->checkbox(['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}']); ?>
	<strong class="clear"></strong>