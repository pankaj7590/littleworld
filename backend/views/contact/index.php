<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Contact;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

switch($searchModel->feedback_type){
	case Contact::TYPE_FEEDBACK:
		$this->title = 'Feedbacks';
		break;
	case Contact::TYPE_INQUIRY:
		$this->title = 'Inquiries';
		break;
	default:
		$this->title = 'Contacts';
		break;
}
$this->params['breadcrumbs'][] = $this->title;

$type = Contact::$types[$searchModel->feedback_type];
?>
<div class="contact-index">
    <p>
        <?= Html::a('Add '.$type, ['create', 'type' => $searchModel->feedback_type], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'surname',
            'email:email',
            'message:ntext',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
