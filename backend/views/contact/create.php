<?php

use yii\helpers\Html;
use common\models\Contact;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$type = Contact::$types[$model->feedback_type];

switch($model->feedback_type){
	case Contact::TYPE_FEEDBACK:
		$types = 'Feedbacks';
		$url = ['feedback'];
		break;
	case Contact::TYPE_INQUIRY:
		$types = 'Inquiries';
		$url = ['inquiry'];
		break;
	default:
		$types = 'Contacts';
		$url = ['index'];
		break;
}

$this->title = 'Add '.$type;
$this->params['breadcrumbs'][] = ['label' => $types, 'url' => $url];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
