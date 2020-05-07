<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\modules\user\forms\LoginForm */

/* @var $show_captcha int */

use app\components\widgets\menu\MenuWidget;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'PhoneLogin';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- HEADER -->
<header class="flex-center">
<span class="profileButton">
    <img src="<?= Yii::getAlias('@web') ?>/images/paradam/user.svg" alt="">
</span>
	<h2><?= Html::encode($this->title) ?></h2>
	<input type="checkbox" id="nav-toggle" hidden>

	<?= MenuWidget::widget() ?>
</header>
<!-- HEADER FIN -->

<section>
	<div class="mainContainer">
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

		<div class="form-group">
			<div class="col-lg-offset-1 col-lg-11">
				<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
			</div>
		</div>

		<?php ActiveForm::end(); ?>

		<p>&nbsp;<br><br></p>
	</div>
</section>
