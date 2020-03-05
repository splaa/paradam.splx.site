<?php
/* @var $subscribe_id integer */
?>

<?php if (Yii::$app->user->id != $user_id): ?>
	<div class="addToFavorite" id="btn-subscribe">
		<?php if ($subscribe_id): ?>
			<img src="<?= Yii::getAlias('@web') ?>/images/paradam/star.svg" alt="">
		<?php else: ?>
			<img src="<?= Yii::getAlias('@web') ?>/images/paradam/star.svg" alt="">
		<?php endif; ?>
	</div>
<?php endif; ?>