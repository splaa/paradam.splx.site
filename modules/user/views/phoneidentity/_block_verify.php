<?php

use borales\extensions\phoneInput\PhoneInput;
use yii\helpers\Html;

?>
<?= $form->field($model, 'telephone')->widget(PhoneInput::className(), [
	'jsOptions' => [
		'nationalMode' => false,
		'allowExtensions' => true,
		'preferredCountries' => ['ua', 'ru', 'pl'],
	]
]);?>

<?= $form->field($model, 'verifyCodeTelephone') ?>

<div class="form-group">
	<div class="btn-group" role="group" aria-label="...">
		<?= Html::button('Телеграм', ['type' => 'button', 'class' => 'btn btn-primary confirm_btn', 'data-type' => 'telegram']) ?>
		<?= Html::button('Звонок', ['type' => 'button', 'class' => 'btn btn-primary confirm_btn', 'data-type' => 'call']) ?>
	</div>
</div>