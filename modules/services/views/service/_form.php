<?php

	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	/* @var $this yii\web\View */
	/* @var $model app\modules\services\models\Service */
	/* @var $form yii\widgets\ActiveForm */
?>

<div class="mainContainer">
	<div class="steps_container">
		<div class="steps step_active">
			<ul>
				<li>1</li>
				<li>2</li>
				<li>3</li>
			</ul>
			<div class="stepsProgress stepsProgress_1"></div>
		</div>
		<p>Step 1</p>
	</div>

	<?php $form = ActiveForm::begin(['options' => ['class' => 'stepTwoBlock', 'enctype' => 'multipart/form-data'], 'fieldConfig' => ['options' => ['tag' => false, 'class' => '']]]); ?>
		<h2>Service information</h2>
		<div class="inputBlock inputBlock-text">
			<p>Service name</p>
			<?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name', 'class' => ''])->label(false)->label(false) ?>
		</div>
		<div class="inputBlock inputBlock-number">
			<p>Service cost in $</p>
			<?= $form->field($model, 'price')->input('range', ['id' => 'costRange', 'min' => 1, 'max' => 50, 'class' => ''])->label(false) ?>
			<output id="totalPrice"></output>
			<div class="ib_tax">-5% <img src="<?= Yii::getAlias('@web') ?>/images/paradam/info.svg" alt=""></div>
		</div>

		<div class="inputBlock inputBlock-textarea" id='question'>
			<p>Service description</p>
			<?= $form->field($model, 'description')->textarea(['rows' => 10, 'cols' => 30, 'placeholder' => 'Description', 'class' => ''])->label(false) ?>
		</div>

		<div class="inputBlock inputBlock-number">
			<p>Days term</p>
			<?= $form->field($model, 'periodOfExecution')->input('range', ['id' => 'dayRange', 'min' => 1, 'max' => 14, 'class' => ''])->label(false) ?>
			<output id="totalDay"></output>
		</div>
	<?php ActiveForm::end(); ?>
</div>