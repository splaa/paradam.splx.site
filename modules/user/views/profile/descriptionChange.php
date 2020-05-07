<?php
// paradam.me.loc/passwordChange.php

use app\components\widgets\menu\MenuWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

?>
<!-- HEADER -->
<header class="flex-center">
	<span class="profileButton">
	    <img src="<?= Yii::getAlias('@web') ?>/images/paradam/user.svg" alt="">
	</span>
	<h2>Изменить Description</h2>
	<input type="checkbox" id="nav-toggle" hidden>

	<?= MenuWidget::widget() ?>
</header>
<!-- HEADER FIN -->

<section>
	<div class="mainContainer"
		<div class="user-form">

			<?php $form = ActiveForm::begin(); ?>

			<?= $form->field($model, 'newDescription')->textInput(['value' => Yii::$app->user->identity->description]) ?>

			<div class="form-group">
				<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'), ['class' => 'btn btn-primary']) ?>
			</div>

			<?php ActiveForm::end(); ?>

		</div>
	</div>
</section>