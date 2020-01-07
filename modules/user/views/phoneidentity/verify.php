<?php

// Default (Template) Project/${FILE_NAME}


use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

$this->title = 'PhoneSignup';
$this->params['breadcrumbs'][] = $this->title;
?>
	<div class="user-default-signup">
		<h1><?= Html::encode($this->title) ?></h1>

		<p>Please fill out the following fields to signup:</p>

		<div class="row">
			<div class="col-lg-5">
				<?php $form = ActiveForm::begin(['id' => 'form-signup-verify']); ?>

				<?= $form->field($model, 'telephone') ?>

				<div class="form-group">
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-default active">
							<input type="radio" checked name="type" value="telegram"> Telegram
						</label>
						<label class="btn btn-default">
							<input type="radio" name="type" value="call"> Звонок последние 4 цыфры
						</label>
					</div>
				</div>

				<div class="form-group">
					<?= Html::button('Подтвердить', ['type' => 'button', 'id' => 'confirm_btn', 'class' => 'btn btn-primary']) ?>
				</div>

				<div class="form-group">
					<?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
				</div>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>

<?php
$js = <<< JS
$(document).ready(function() {
	$('#confirm_btn').click(function(){
		$.ajax({
			url: '/user/phoneidentity/telephone-code-confirm',
			data: 'type=' + $('input[name="type"]').val() + '&telephone=' + $('#phonesignupform-telephone').val(),
			type: 'POST',
			success: function (res) {
				console.log(res);
			},
			error: function () {
			
			}
		});
	})
});
JS;

$this->registerJs($js);

?>