<?php


	use yii\bootstrap\Modal;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	Modal::begin([
		'header' => '<h2>Hello world</h2>',
		'toggleButton' => [
			'label' => 'click me',
			'class' => 'btn btn-success'
		],
		'footer' => 'Низ окна',
	]);

	echo $message ??= 'Услуги';


	$form = ActiveForm::begin();

	echo $form->field($answer, 'answer')->label('Ответы');
	echo $form->field($comment, 'comment')->textarea()->label('Коментарии');

	echo Html::submitButton('Comment', ['class' => 'btn btn-success']);
	ActiveForm::end();

	Modal::end();

