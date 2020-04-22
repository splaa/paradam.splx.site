<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $languages array */

?>
<div class="user-profile-password-change">

	<h1>Изменить Язык</h1>

	<div class="user-form">

		<?php $form = ActiveForm::begin(); ?>

		<?php $model->languages = explode(',', Yii::$app->user->identity->languages); ?>
		<?=
			$form->field($model, 'languages')->widget(Select2::classname(), [
				'data' => $languages,
				'options' => ['placeholder' => 'Select a languages ...', 'multiple' => true],
				'pluginOptions' => [
					'tags' => true,
					'tokenSeparators' => [','],
					'maximumInputLength' => 10
				],
			])->label('Languages');
		?>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>