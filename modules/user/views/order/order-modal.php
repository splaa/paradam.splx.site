<?php
	/**
	 * @var $service \app\modules\services\models\Service
	 * @var $user_id integer
	 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Услуги";
	Yii::$app->params['modalTitle'] = 'Услуги'
?>

<!-- HEADER -->
<header>
	<div class="headerContainer">
        <span class="backButton">
            <img src="<?= Yii::getAlias('@web') ?>/images/paradam/back_arrow.svg" alt="">
        </span>
		<h2><?= $service->name; ?></h2>
	</div>
</header>
<!-- HEADER FIN -->
<form action="<?= Url::to(['order/save']) ?>" id="send_service_form">
	<section>
		<div class="mainContainer">
			<?php if (!empty($service)): ?>
				<h2>Service information</h2>

				<div class="textblock">
					<p>Service name</p>
					<span><?= $service->name; ?></span>
				</div>
				<div class="textblock">
					<p>Service description</p>
					<span><?= $service->description; ?></span>
				</div>
				<div class="textblock textBlock-number">
					<p>Days term</p>
					<span><?= $service->periodOfExecution; ?></span>
				</div>

				<div class="questionblock">
					<?php foreach ($service->questions as $question): ?>
						<p><?= $question->question ?></p>
						<input type="text" name="answered[<?= $service->id ?>][<?= $question->id ?>]" placeholder="Answer" value="" class="req" data-error="Обязательно для заполнения" />
					<?php endforeach; ?>

					<p>Comment</p>
					<textarea name="comment" id="comment" cols="30" rows="10" placeholder="Comment"></textarea>
				</div>

				<div class="form-group clearfix">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="terms_of_use" value="1" checked> Согласен с пользовательским соглашением
						</label>
					</div>
				</div>
			<?php else: ?>
				<div class="alert alert-danger">Пусто</div>
			<?php endif; ?>
		</div>
	</section>

	<?php if (!empty($service)): ?>
		<section>
			<div class="stepsButtons">
				<div class="stepsButtonsContainer">
					<div class="checkout_price flex">
						<p>Total</p>
						<span><?= $service->convertPriceToUSD ?></span>

					</div>
					<div class="sb_button sb_checkout sb_next">
						<a href="#" onclick="$(this).parents('form').submit();return false;">Checkout payment</a>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<input type="hidden" value="<?= $user_id ?>" name="user_id" />
</form>


