<?php

use kartik\date\DatePicker;


/**
 * @var $form \yii\bootstrap\ActiveForm;
 */
?>
<?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'last_name')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'email') ?>

<?= $form->field($model, 'country')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'birthday')->widget(DatePicker::className(),[
	'type' => DatePicker::TYPE_INPUT,
	'pluginOptions' => [
		'autoclose'=>true,
		'format' => 'dd.mm.yyyy'
	]
]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>