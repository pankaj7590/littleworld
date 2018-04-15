<?php
use common\models\Setting;
	
//footer options
$footerOptionModels = Setting::find()->where(['setting_group' => Setting::GROUP_FOOTER])->all();
$footerOptions = [];
foreach($footerOptionModels as $model){
	$footerOptions[$model->name] = $model;
}
?>
<footer>
	<p>&copy; <?= date('Y');?> <?= (isset($footerOptions['footer_copyright']['value'])?$footerOptions['footer_copyright']['value']:Yii::$app->name);?></p>
	<p>Website developed by <a target="_blank" href="<?= (isset($footerOptions['footer_developer_link']['value'])?$footerOptions['footer_developer_link']['value']:'http://salokhe.in/')?>" class="link"><?= (isset($footerOptions['footer_developer']['value'])?$footerOptions['footer_developer']['value']:'Pankaj Salokhe')?></a></p>
</footer>