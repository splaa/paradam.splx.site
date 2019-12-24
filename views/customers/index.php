<?php

// Default (Template) Project/${FILE_NAME}
	
	/**
	 * @var $this View
	 * @var $records
	 */
	
	use yii\web\View;
	
	echo \yii\widgets\ListView::widget(
		[
			'options' => [
				'class' => 'list-view',
				'id' => 'search_results'
			],
			'itemView' => '_customer',
			'dataProvider' => $records
		]
	);