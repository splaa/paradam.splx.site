<?php
/* @var $model \app\modules\user\models\User */
/* @var $messageForm \app\modules\message\forms\MessageForm */
/* @var $services \app\modules\services\models\Service[] */
/* @var $this yii\web\View */
/* @var $subscribe_id integer */

/* @var $count integer */

use app\assets\AppAsset;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->request->baseUrl . '@web/js/order.js', ['depends' => [AppAsset::class]]);
?>

<header class="profileHeader">
	<div class="headerContainer headerContainer-profile">
        <span onclick="main.back()" class="backButton">
            <img src="<?= Yii::getAlias('@web') ?>/images/paradam/back_arrow.svg" alt="">
        </span>
		<h2><?= $model->first_name . ' ' . $model->last_name ?></h2>
		<span class="backButton">
            <?= $this->render('_subscribe_btn', [
	            'subscribe_id' => $subscribe_id,
	            'user_id' => $model->id
            ]) ?>
        </span>
	</div>

</header>

<section>
	<div class="carousel" data-flickity='{ "cellAlign": "left", "contain": true }'>
		<div class="carousell_cell">
			<div class="pup_fader"></div>
			<div class="profileUserPhoto">
				<img src="<?= $model->avatarOrigin ?>" alt="">
			</div>

		</div>
		<div class="carousell_cell">
			<div class="cc_header_bg"></div>
			<div class="profileUserContainer">
				<div class="profileUserInfo">
					<div class="pui_top">
						<div class="pui_left">
							<div class="userAvatarMIn" style="background: url(<?= $model->avatarSmall ?>)">
							</div>
						</div>
						<div class="pui_right">
							<div class="userNickName_container">
								<span>username</span>
								<h3 class="userNickName">@<?= $model->username ?></h3>
							</div>
							<div class="userBookMarks">
								<span>on bookmarks</span>
								<div class="ubm_counter"><?= $count ?></div>
							</div>
						</div>
					</div>

					<div class="userProfileDescription">
						<div class="upd_text">
							<?= $model->description ?>
						</div>
						<div class="upd_link">
							<a href="<?= $model->link ?>" target="_blank"><?= $model->linkFormat ?></a>
						</div>
						<div class="upd_lang">
							<ul>
								<li class="updl_eng">English</li>
								<li class="updl_ru">Russian</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="upd_button">
		<input type="button" id="send_msg" value="Send message for <?= $model->formatSmsCost ?>" />
	</div>

	<div class="mainContainer">

		<div class="userServices">
			<p class="us_title"><?= $model->first_name . ' ' . $model->last_name ?> offers:</p>

			<div class="us_itemsContainer">
				<?php foreach ($services as $service): ?>
					<?php if (Yii::$app->user->id != $model->id): ?>
						<div class="usic_item make-order" data-id="<?= $service->id ?>" data-user-id="<?= $model->id ?>">
					<?php else: ?>
						<div class="usic_item">
					<?php endif; ?>
						<div class="usici_top">
							<div class="usicit_name"><?= $service->name ?></div>
							<div class="usicit_price"><?= $service->formatPrice ?></div>
						</div>
						<div class="usici_mid">
							<div class="usicim_description">
								<?= $service->description ?>
							</div>
							<span class="usicim_favorite">
	                            <img src="<?= Yii::getAlias('@web') ?>/images/paradam/heart.svg" alt="">
	                        </span>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>