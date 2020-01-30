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
		'enableClientValidation' => false,
		'validateOnChange' => false,
		'validateOnSubmit' => true,
		'validateOnBlur' => false,
	]); ?>





	<?= $form->field($model, 'questions')
		->widget(MultipleInput::className(), ['max' => 4,]); ?>


    <div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); ?>


</div>