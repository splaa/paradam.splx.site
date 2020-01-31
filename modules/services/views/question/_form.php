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





	<?= $form->field($model, 'questions')
		->widget(MultipleInput::className(), ['max' => 4,]); ?>



	<?= $form->field($model, 'convention')->checkbox(); ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>


</div>