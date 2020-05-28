<?php

use app\components\widgets\menu\MenuWidget;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'PhoneSignup';
$this->params['breadcrumbs'][] = $this->title;
?>
	<header class="loginHeader">
		<h2>Paradam,</h2>
	</header>

	<!-- HEADER FIN -->
	<section class="registration">
		<?php $form = ActiveForm::begin([
			'id' => 'registrationForm',
			'options' => [
				'class' => 'registration__form',
			],
			'layout' => 'horizontal',
			'fieldConfig' => [
				'template' => "{input}\n<div>{error}</div>",
				'labelOptions' => ['class' => ''],
				'options' => [

				]
			],
		]); ?>
		<!-- Nav tabs -->
		<ul class="hide" id="stepsRegister" role="tablist">
			<li role="presentation" class="active"><a href="#step_1" aria-controls="step_1" role="tab" data-toggle="tab"></a></li>
			<li role="presentation"><a href="#step_2" aria-controls="step_2" role="tab" data-toggle="tab"></a></li>
			<li role="presentation"><a href="#step_3" aria-controls="step_3" role="tab" data-toggle="tab"></a></li>
			<li role="presentation"><a href="#step_4" aria-controls="step_4" role="tab" data-toggle="tab"></a></li>
		</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="step_1" data-tab-next="step_2">
					<div class="tabs registration__tabs">
						<div class="tabs__control">
							<div class="tabs__item tabs__item_active">
								КОД В ТЕЛЕГРАМ
							</div>
							<div class="tabs__item">
								ЗВОНОК НА НОМЕР
							</div>
						</div>
						<div class="registration__inputWrapper">
							<div class="inputTelCode">
								<input type="hidden" name="type" value="telegram" />
								<?= $form->field($model, 'telephone')->textInput(['autofocus' => true, 'type' => 'tel', 'class' => 'inputTelCode__input', 'placeholder' => 'Номер телефона, имя пользователя или эл.почта'])->label(false) ?>
							</div>
						</div>
					</div>
					<div class="registration__wrapper">
						<?= $form->field($model, 'reCaptcha')->widget(ReCaptcha2::className()) ?>
						<div class="registration__control">
							<?= Html::button('Дальше', [
								'class' => 'pButton actionValidate',
								'data-tab-next' => '#step_2'
							]) ?>
							<?php
//							Html::a('Дальше', ['#step_2'], [
//								'class' => 'pButton actionValidate',
//								'aria-controls' => 'step_2',
//								'role' => 'tab',
//								'data-toggle' => 'tab',
//							])
							?>
						</div>
					</div>
					<div class="loginForm__registrationLink">
						<span>Уже имею учетную запись!</span>
						<?= Html::a('Ввойти', ['/user/default/phonelogin'], ['class' => '']) ?>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="step_2" data-tab-next="step_3">
					<h3 class="registration__title">Введите код подтверждения</h3>
					<div class="registration__description">
						Введите код, отправленый в Telegram +38098 432 4130 <a href="/registration.html">Изменить номер</a> или <a href="#">Отправить код в Telegram еще раз</a>
					</div>
					<div class="registration__inputWrapper">
						<input type="text" name="code" placeholder="Код подтверждения" />
					</div>
					<div class="registration__inputWrapper">
						<div class="registration__control">
							<?= Html::a('Дальше', ['#step_3'], [
								'class' => 'pButton',
								'aria-controls' => 'step_3',
								'role' => 'tab',
								'data-toggle' => 'tab',
							]) ?>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="step_3" data-tab-next="step_4">
					<h3 class="registration__title">Введите имя и пароль</h3>
					<div class="registration__description">
						Добавьте свое имя, что б друзья могли найти вас
					</div>
					<div class="registration__inputWrapper">
						<input type="text" name="name" placeholder="Полное имя" autocomplete="off" />
					</div>
					<div class="registration__inputWrapper">
						<input type="text" name="username" placeholder="Ваш логин" autocomplete="off" />
					</div>
					<div class="registration__inputWrapper">
						<input type="password" name="password" placeholder="Пароль"  autocomplete="off"/>
					</div>
					<div class="registration__inputWrapper">
						<div class="registration__control">
							<?= Html::a('Дальше', ['#step_4'], [
								'class' => 'pButton',
								'aria-controls' => 'step_3',
								'role' => 'tab',
								'data-toggle' => 'tab',
							]) ?>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="step_4">
					<h3 class="registration__title">Поздравляем в Paradam, ИМЯ_ПОЛЬЗОВАТЕЛЯ!</h3>
					<div class="registration__description">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
						<div class="registration__inputWrapper">
							<a href="/registration_3.html">Изменить имя пользователя</a>
						</div>
					</div>
					<div class="registration__inputWrapper">
						<div class="registration__control">
							<?= Html::submitButton('Ввойти', ['class' => 'pButton', 'name' => 'signup-button']) ?>
						</div>
					</div>
					<div class="registration__description">
						Регестрируясь, вы принимаете наши
						<a href="#" class="black">Условия, Политику использования данных</a> и <a href="#" class="black">Политику по файлов cookie</a>.
					</div>
				</div>
			</div>
		<?php ActiveForm::end(); ?>
	</section>






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
	});
	
	$('.actionValidate').click(function(e){
	    e.preventDefault();
	    // let tab_next = $(this).data('tab-next');
	    // $('#stepsRegister a[href="' + tab_next + '"]').tab('show');
	    $('#registrationForm').submit();
	    // $('#registrationForm').submit();
        //
		// $('#registrationForm').on('beforeSubmit', function (e) {
		// if (!confirm("Everything is correct. Submit?")) {
		// 	return false;
		// }
		// return true;
	});
	var form = $('#registrationForm');
	form.on('beforeSubmit', function() {
	    var data = form.serialize();
	    $.ajax({
	        url: form.attr('action'),
	        type: 'POST',
	        data: data,
	        success: function (data) {
	            // console.log(data);
	            // Implement successful
				let tab_next = $(this).find('.tab-pane.active').data('tab-next');
				$('#stepsRegister a[href="' + tab_next + '"]').tab('show');
	        },
	        error: function(jqXHR, errMsg) {
	            
	        }
	     });
	     return false; // prevent default submit
	});
});
JS;

$this->registerJs($js);

?>