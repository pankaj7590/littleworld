<?php

use yii\helpers\Html;
use common\models\NewsEvent;

/* @var $this yii\web\View */
/* @var $model common\models\NewsEvent */

switch($model->type){
	case NewsEvent::TYPE_EVENT:
		$type = 'Event';
		$label = 'Events';
		$url = ['event-index'];
		break;
	default:
		$type = 'News';
		$label = 'News';
		$url = ['index'];
		break;
}
$this->title = 'Update '.$type.': '.$model->title;
$this->params['breadcrumbs'][] = ['label' => $label, 'url' => $url];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="news-event-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
