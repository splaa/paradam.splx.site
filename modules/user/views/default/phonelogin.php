<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\modules\user\forms\LoginForm */

/* @var $show_captcha int */

use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'PhoneLogin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
				'layout' => 'horizontal',
				'fieldConfig' => [
					'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
					'labelOptions' => ['class' => 'col-lg-1 control-label'],
				],
			]); ?>
			
			<?= $form->field($model, 'phone')->textInput(['autofocus' => true]) ?>
			
			<?= $form->field($model, 'password')->passwordInput() ?>
			
			<?= $form->field($model, 'rememberMe')->checkbox([
				'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
			]) ?>

			<?php if ($show_captcha): ?>
			<?= $form->field($model, 'reCaptcha')->widget(ReCaptcha2::className(),[]) ?>
	        <?php endif; ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
			<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>
	
	<?php ActiveForm::end(); ?>

    <div class="col-lg-offset-1" style="color:#999;">
        Вы можете войти с <strong>1234567891/admin</strong> or <strong>2345678912/demo</strong>.<br>
        Чтобы изменить phone/password, please check out the code <code>app\models\User::$users</code>.
    </div>
</div>
