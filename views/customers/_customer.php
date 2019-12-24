<?php
	// paradam.me.loc/_customer.php
	
	use yii\widgets\DetailView;
	
	echo DetailView::widget(
		[
			'model' => $model,
			'attributes' => [
				['attribute' => 'name'],
				[
					'attribute' => 'birth_data',
					'value' => $model->birth_date->format('Y-m-d')
				],
				'notes:text',
				['label' => 'Phone Number', 'attribute' => 'phones.0.number']
			]
		]
	);