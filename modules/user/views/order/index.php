<?php


	use yii\bootstrap\Modal;

	Modal::begin([
		'header' => '<h2>Hello world</h2>',
		'toggleButton' => [
			'label' => 'click me',
			'tag' => 'button',
			'class' => 'btn btn-success',
		],
		'footer' => 'footer....'
	]);

	echo 'Say hello...';

	Modal::end();