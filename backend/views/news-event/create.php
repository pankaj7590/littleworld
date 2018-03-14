<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\NewsEvent */

$this->title = 'Create News Event';
$this->params['breadcrumbs'][] = ['label' => 'News Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
