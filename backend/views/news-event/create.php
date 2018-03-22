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

$this->title = 'Add '.$type;
$this->params['breadcrumbs'][] = ['label' => $label, 'url' => $url];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-event-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
