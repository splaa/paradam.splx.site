<?php
	
	// Default (Template) Project/${FILE_NAME}
	
	/* @var $this View */
	
	use yii\helpers\Html;
	use yii\web\View;

?>

<?= Html::beginForm(['/customers'], 'get') ?>
<?= Html::label('Phone number to search:', 'phone_number') ?>
<?= Html::textInput('phone_number') ?>
<?= Html::submitButton('Search') ?>
<?= Html::endForm(); ?>
