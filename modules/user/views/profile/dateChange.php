<?php
// paradam.me.loc/passwordChange.php

use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

?>
<div class="user-profile-password-change">

	<h1>Изменить Дату рождения</h1>

	<div class="user-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'newDate')->widget(DatePicker::className(),[
			'type' => DatePicker::TYPE_COMPONENT_PREPEND,
			'pluginOptions' => [
				'autoclose'=>true,
				'format' => 'dd.mm.yyyy'
			]
		]) ?>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>