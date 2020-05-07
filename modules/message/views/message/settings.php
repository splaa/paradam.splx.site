<?php

/* @var $this \yii\web\View */
/* @var $currency string */


use app\components\widgets\menu\MenuWidget;
use app\widgets\Alert;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Settings Message';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- HEADER -->
<header class="flex-center">
    <span class="profileButton">
        <img src="<?= Yii::getAlias('@web') ?>/images/paradam/user.svg" alt="">
    </span>
	<h2><?= Html::encode($this->title) ?></h2>
	<input type="checkbox" id="nav-toggle" hidden>

	<?= MenuWidget::widget() ?>
</header>
<!-- HEADER FIN -->

<section>
	<div class="mainContainer">
		<?= Alert::widget() ?>

		<div class="user-form">
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
</section>