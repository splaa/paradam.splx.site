<?php
	
	/* @var $this yii\web\View */
	/* @var $form yii\bootstrap\ActiveForm */
	
	/* @var $model LoginForm */

use app\modules\user\models\LoginForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
	
	$this->title = 'Login';
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>
	
	<?php $form = ActiveForm::begin([
		'id' => 'login-form',
		'layout' => 'horizontal',
		'fieldConfig' => [
			'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
			'labelOptions' => ['class' => 'col-lg-1 control-label'],
		],
	]); ?>

	<?= $form->field($model, 'telephone')->textInput(); ?>
	
	<?= $form->field($model, 'password')->passwordInput() ?>

	<?= $form->field($model, 'code')->textInput() ?>

	<?= $form->field($model, 'rememberMe')->checkbox([
		'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
	]) ?>

	<div class="btn-group" data-toggle="buttons">
		<label class="btn btn-default active">
			<input type="radio" checked name="type" value="telegram"> Telegram
		</label>
		<label class="btn btn-default">
			<input type="radio" name="type" value="call"> Звонок последние 4 цыфры
		</label>
	</div>

	<?= Html::button('Подтвердить', ['type' => 'button', 'id' => 'confirm_btn', 'class' => 'btn btn-primary']) ?>

    <div class="form-group" style="display: none;">
        <div class="col-lg-offset-1 col-lg-11">
			<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>
	
	<?php ActiveForm::end(); ?>

	<?php
		$js = <<< JS
$(document).ready(function() {
	$('#confirm_btn').click(function(){
		$.ajax({
			url: '/user/default/code',
			data: 'type=' + $('input[name="type"]').val() + '&telephone=' + $('#loginform-telephone').val(),
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
</div>
