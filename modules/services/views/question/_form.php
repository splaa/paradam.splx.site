<?php

	use app\modules\services\models\Question;
	use unclead\multipleinput\MultipleInput;
	use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;


	/* @var $this yii\web\View */
	/* @var $model Question */

?>

<div class="user-form">

	<?php $form = ActiveForm::begin([
		'enableAjaxValidation' => false,
		'enableClientValidation' => true,
		'validateOnChange' => true,
		'validateOnSubmit' => true,
		'validateOnBlur' => true,
	]); ?>





	<?= $form->field($model, 'questions')->widget(MultipleInput::className(), ['max' => 4,]); ?>



	<?= $form->field($model, 'convention')->checkbox(); ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>


</div>

<div class="mainContainer">
	<div class="steps_container">
		<div class="steps step_active_two">
			<ul>
				<li><img src="<?= Yii::getAlias('@web') ?>/images/paradam/tick.svg" alt=""></li>
				<li>2</li>
				<li>3</li>
			</ul>
			<div class="stepsProgress stepsProgress_2"></div>
		</div>
		<p>Step 2</p>
	</div>
	<h2>Questions for buyer</h2>
	<?php $form = ActiveForm::begin([
		'enableAjaxValidation' => false,
		'enableClientValidation' => true,
		'validateOnChange' => true,
		'validateOnSubmit' => true,
		'validateOnBlur' => true
	]); ?>
		<div class="questions_container">
			<div class="inputBlock inputBlock-text">
				<?= $form->field($model, 'questions')->widget(MultipleInput::className(), [
					'max' => 4,
					'theme' => MultipleInput::THEME_DEFAULT,
					'rendererClass' => \unclead\multipleinput\renderers\DivRenderer::className(),
					'addButtonPosition' => MultipleInput::POS_FOOTER,
					'removeButtonOptions' => [
						'class' => 'ib_remover flex-icon'
					]
				]); ?>
			</div>
			<div class="inputBlock inputBlock-text">
				<p>Question for buyers 1</p>
				<input type="text" placeholder="Name">
			</div>
			<div class="inputBlock inputBlock-text">
				<p>Question for buyers 1</p>
				<div class="ib_removeble_container">
					<input type="text" placeholder="Name">
					<span class="ib_remover flex-icon"><img src="<?= Yii::getAlias('@web') ?>/images/paradam/input_eraser.svg" alt=""></span>
				</div>
			</div>
			<div class="inputBlock inputBlock-adder">
				<p>Add question</p>
				<input type="button" placeholder="Name">
			</div>
		</div>
	<?php ActiveForm::end(); ?>
</div>