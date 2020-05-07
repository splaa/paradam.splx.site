<?php

use app\components\widgets\menu\MenuWidget;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'PhoneSignup';
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

		<div class="row">
			<?= $form->field($model, 'subscribe')->checkbox() ?>
		</div>

		<div class="form-group">
			<?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
		</div>
		<?php ActiveForm::end(); ?>
	</div>

	<p>&nbsp;<br><br><br></p>
</section>


<?php
$url = Url::to(['phoneidentity/telephone-code-confirm']);
$js = <<< JS
$(document).ready(function() {
	$('.confirm_btn').click(function(){
	    let input = $('#phonesignupform-telephone');
		$.ajax({
			url: '{$url}',
			data: 'type=' + $(this).data('type') + '&telephone=' + input.val(),
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