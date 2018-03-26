<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
      <div class="grid_4 bot-1">
        <h2 class="top-6">Contact Us</h2>
        <div class="map">
          <iframe src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Brooklyn,+New+York,+NY,+United+States&amp;aq=0&amp;sll=37.0625,-95.677068&amp;sspn=61.282355,146.513672&amp;ie=UTF8&amp;hq=&amp;hnear=Brooklyn,+Kings,+New+York&amp;ll=40.649974,-73.950005&amp;spn=0.01628,0.025663&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
        </div>
        <dl>
          <dt>8901 Marmora Road, <br>
            Glasgow, D04 89GR.</dt>
          <dd><span>Telephone: </span>+1 800 603 6035</dd>
          <dd><span>E-mail: </span><a href="#" class="link">mail@demolink.org</a></dd>
        </dl>
      </div>
      <div class="grid_8">
        <div class="block-1 top-5">
          <div class="block-1-shadow">
            <h2 class="clr-6">Register</h2>
            <?php $form = ActiveForm::begin(['id' => 'form']); ?>
                <?= $form->field($model, 'username', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput(['autofocus' => true]) ?>
                  <strong class="clear"></strong>
                <?= $form->field($model, 'name', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput() ?>
                  <strong class="clear"></strong>
                <?= $form->field($model, 'address', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textArea(['rows' => 1]) ?>
                  <strong class="clear"></strong>
                <?= $form->field($model, 'email', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}']) ?>
                  <strong class="clear"></strong>
                <?= $form->field($model, 'phone', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->textInput() ?>
                  <strong class="clear"></strong>
                <?= $form->field($model, 'password', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->passwordInput() ?>
                  <strong class="clear"></strong>
				<?= $form->field($model, 'captcha', ['template' => '{beginLabel}<strong>{label}</strong>{input}{endLabel}{error}'])->widget(\yii\captcha\Captcha::classname(), []) ?>
                  <strong class="clear"></strong>
                <div class="btns pad-2">
                    <?= Html::submitButton('Register', ['class' => 'link-2', 'id' => 'signup-submit-btn', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
          </div>
        </div>
					<?= $this->render('../layouts/_footer.php')?>
      </div>