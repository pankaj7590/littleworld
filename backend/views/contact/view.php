<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Contact;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

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
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $types, 'url' => $url];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'surname',
            'email:email',
            [
				'attribute' => 'feedback_type',
				'value' => function($data){
					return ($data->feedback_type?Contact::$types[$data->feedback_type]:NULL);
				},
			],
            'message:ntext',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
