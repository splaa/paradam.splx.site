<?php

	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	/* @var $this yii\web\View */
	/* @var $model app\modules\services\models\OrderSearch */
	/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
		'options' => [
			'data-pjax' => 1
		],
	]); ?>

	<?= $form->field($model, 'id') ?>

	<?= $form->field($model, 'user_id') ?>

	<?= $form->field($model, 'service_id') ?>

	<?= $form->field($model, 'question_id') ?>

	<?= $form->field($model, 'answer_id') ?>

	<?php // echo $form->field($model, 'comment_id') ?>

	<?php // echo $form->field($model, 'created_at') ?>

	<?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
