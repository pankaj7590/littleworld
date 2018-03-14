<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Guardian */

$this->title = 'Create Guardian';
$this->params['breadcrumbs'][] = ['label' => 'Guardians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guardian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
