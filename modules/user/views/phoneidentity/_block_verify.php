<?php

use yii\helpers\Html;

?>
<?= $form->field($model, 'telephone') ?>
<?= $form->field($model, 'verifyCodeTelephone') ?>

<div class="form-group">
	<div class="btn-group" role="group" aria-label="...">
		<?= Html::button('Телеграм', ['type' => 'button', 'class' => 'btn btn-primary confirm_btn', 'data-type' => 'telegram']) ?>
		<?= Html::button('Звонок', ['type' => 'button', 'class' => 'btn btn-primary confirm_btn', 'data-type' => 'call']) ?>
	</div>
</div>