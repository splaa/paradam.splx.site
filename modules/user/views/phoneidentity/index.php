<?php

// Default (Template) Project/${FILE_NAME}


use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'PhoneSignup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-signup">
	<div class="row">
		<div class="col-lg-12">
			<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
			<div>

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#tab_register" aria-controls="tab_register" role="tab" data-toggle="tab"><?= Html::encode($this->title) ?></a></li>
					<li role="presentation"><a href="#tab_telephone" aria-controls="tab_telephone" role="tab" data-toggle="tab">Подтверждение телефона</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="tab_register">
						<?= $this->render('_block_form', compact($model, $form)) ?>

						<div class="form-group">
							<?= Html::button('Продолжить', ['class' => 'btn btn-success', 'id' => 'button_next']) ?>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="tab_telephone">
						<?= $this->render('_block_verify', compact($model, $form)) ?>

						<div class="form-group">
							<?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
						</div>
					</div>
				</div>

			</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>

<?php
$url = Url::to(['phoneidentity/telephone-code-confirm']);
$js = <<< JS
$(document).ready(function() {
    $('#button_next').click(function(){
	    $('#tab_telephone').tab('show');
	});
	$('.confirm_btn').click(function(){
		$.ajax({
			url: '{$url}',
			data: 'type=' + $(this).data('type') + '&telephone=' + $('#phonesignupverifyform-telephone').val(),
			type: 'POST',
			success: function (res) {
				console.log(res);
			},
			error: function () {}
		});
	})
	
});
JS;

$this->registerJs($js);

?>