<?php

	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	/* @var $this yii\web\View */
	/* @var $model app\modules\services\models\Answer */
	/* @var $form yii\widgets\ActiveForm */
?>

<div class="answer-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'question_id')->textInput() ?>

	<?= $form->field($model, 'order_id')->textInput() ?>

	<?= $form->field($model, 'answer')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'created_at')->textInput() ?>

	<?= $form->field($model, 'updated_at')->textInput() ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
