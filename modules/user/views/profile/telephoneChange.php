<?php
// paradam.me.loc/passwordChange.php

use app\widgets\Alert;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

?>
<div class="user-profile-password-change">
	<?= Alert::widget() ?>

	<h1><?= Html::encode($this->title) ?></h1>

	<div class="user-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true]) ?>
		<?= $form->field($model, 'telephone')->textInput(['value' => Yii::$app->user->identity->telephone]) ?>
		<?= $form->field($model, 'verifyCodeTelephone') ?>

		<div class="form-group">
			<div class="btn-group" role="group" aria-label="...">
				<?= Html::button('Телеграм', ['type' => 'button', 'class' => 'btn btn-primary confirm_btn', 'data-type' => 'telegram']) ?>
				<?= Html::button('Звонок', ['type' => 'button', 'class' => 'btn btn-primary confirm_btn', 'data-type' => 'call']) ?>
			</div>
		</div>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>

<?php
$url = Url::to(['phoneidentity/telephone-code-confirm']);
$js = <<< JS
$(document).ready(function() {
	$('.confirm_btn').click(function(){
		$.ajax({
			url: '{$url}',
			data: 'type=' + $(this).data('type') + '&telephone=' + $('#telephonechangeform-telephone').val(),
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