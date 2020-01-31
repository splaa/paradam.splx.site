<?php
/* @var $subscribe_id integer */
/* @var $count integer */

use yii\helpers\Html;

?>

<?php if (Yii::$app->user->id != $user_id): ?>
	<div style="text-align: center" id="btn-subscribe-wrapper">
		<?php if ($subscribe_id): ?>
			<?= Html::button('Отписаться' . ($count ? ' (' . $count . ')' : ''), ['class' => 'btn btn-danger', 'id' => 'btn-subscribe']) ?>
		<?php else: ?>
			<?= Html::button('Подписаться' . ($count ? ' (' . $count . ')' : ''), ['class' => 'btn btn-primary', 'id' => 'btn-subscribe']) ?>
		<?php endif; ?>
	</div>
<?php endif; ?>