<?php
	// Default (Template) Project/${FILE_NAME}
	
	use app\models\customer\CustomerRecord;
	use app\models\customer\PhoneRecord;
	use yii\helpers\Html;
	use yii\web\View;
	use yii\widgets\ActiveForm;
	
	
	/**
	 * Add Customer UI
	 * @var $this View
	 * @var CustomerRecord $customer
	 * @var PhoneRecord $phone
	 */
	
	$form = ActiveForm::begin([
		'id' => 'add-customer-from',
	]);
?>

<?= $form->errorSummary([$customer, $phone]) ?>
<?= $form->field($customer, 'name') ?>
<?= $form->field($customer, 'birth_date') ?>
<?= $form->field($customer, 'notes') ?>

<?= $form->field($phone, 'number') ?>
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>
