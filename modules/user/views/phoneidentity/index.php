<?php

use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'PhoneSignup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-signup">
	<div class="row">
		<div class="col-lg-12">
			<h1><?= Html::encode($this->title) ?></h1>
			<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
				<?= $this->render('_block_form', [
					'model' => $model,
					'form' => $form
				]) ?>

				<?= $this->render('_block_verify', [
					'model' => $model,
					'form' => $form
				]) ?>

				<?= $form->field($model, 'reCaptcha')->widget(ReCaptcha2::className(),[]) ?>

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
			data: 'type=' + $(this).data('type') + '&telephone=' + $('#phonesignupform-telephone').val(),
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