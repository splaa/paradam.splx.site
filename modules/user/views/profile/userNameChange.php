<?php
// paradam.me.loc/passwordChange.php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

?>
<div class="user-profile-password-change">

	<h1>Изменить Username</h1>

	<div class="user-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'newUserName')->textInput(['value' => Yii::$app->user->identity->username]) ?>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>