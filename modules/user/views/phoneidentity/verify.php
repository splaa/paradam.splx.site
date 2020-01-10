<?php

// Default (Template) Project/${FILE_NAME}

/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */
/* @var $model \app\modules\user\forms\PhoneSignupVerifyForm */

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'PhoneSignup';
$this->params['breadcrumbs'][] = $this->title;
?>
	<div class="user-default-signup">
		<h1><?= Html::encode($this->title) ?></h1>

		<p>Please fill out the following fields to signup:</p>

		<div class="row">
			<div class="col-lg-5">
				<?php $form = ActiveForm::begin(['id' => 'form-signup-verify', 'action' => '/user/phoneidentity/verify?id='.$user->id]); ?>

				<?= $form->field($model, 'telephone')->input('text', ['value' => $user->telephone]) ?>
				<?= $form->field($model, 'verifyCode') ?>

				<div class="form-group">
					<div class="btn-group" role="group" aria-label="...">
						<?= Html::button('Телеграм', ['type' => 'button', 'class' => 'btn btn-primary confirm_btn', 'data-type' => 'telegram']) ?>
						<?= Html::button('Звонок', ['type' => 'button', 'class' => 'btn btn-primary confirm_btn', 'data-type' => 'call']) ?>
					</div>
				</div>

				<div class="form-group">
					<?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
				</div>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>

<?php
$url = Url::to(['phoneidentity/telephone-code-confirm']);
$js = <<< JS
$(document).ready(function() {
	$('.confirm_btn').click(function(){
		$.ajax({
			url: '{$url}',
			data: 'type=' + $(this).data('type') + '&telephone=' + $('#phonesignupverifyform-telephone').val(),
			type: 'POST',
			success: function (res) {
				console.log(res);
			},
			error: function () {}
		});
	})
});
JS;

$this->registerJs($js);

?>