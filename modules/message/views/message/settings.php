<?php

/* @var $this \yii\web\View */
/* @var $currency string */


use app\widgets\Alert;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Settings Message';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-reset-password">
	<?= Alert::widget() ?>

	<h1><?= Html::encode($this->title) ?></h1>

	<p>Settings Message Form</p>

	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'settings-form']); ?>

			<?= $form->field($model, 'sms_cost')->textInput(['type' => 'number', 'value' => Yii::$app->user->identity->sms_cost]) ?>

			<p>=</p>
			<p><?= Yii::$app->user->identity->convertSmsCostToUSD ?></p>

			<div class="form-group">
				<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
			</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
