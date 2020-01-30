<?php
/**
 * @var $dataProvider
 */

use yii\grid\GridView;
use yii\helpers\Html;

?>
<div class="container">
	<h1>Баланс: <?= Yii::$app->user->identity->formatBalance ?></h1>

	<?= Html::button('Пополнить', ['class' => 'btn btn-success', 'type' => 'button']) ?>
	<?= Html::button('Вывести', ['class' => 'btn btn-danger', 'type' => 'button']) ?>

	<?=
		GridView::widget([
			'dataProvider' => $dataProvider,
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],
				[
					'attribute' => 'type',
					'format' => 'html',
					'value' => function($data){
						return $data->getNameType($data->type);
					}
				],
				[
					'attribute' => 'additional',
					'format' => 'html',
					'value' => function($data){
						return $data->getAdditionalFormated($data->additional);
					}
				],
				[
					'attribute' => 'created_at',
					'format' => 'text',
					'value' => function($data){
						return Yii::$app->formatter->asDatetime($data->created_at);
					}
				]
			],
		]);
	?>
</div>