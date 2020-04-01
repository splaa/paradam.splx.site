<?php
/* @var $this View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
	<!DOCTYPE html>
	<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
		<?php $this->registerCsrfMetaTags() ?>

		<title><?= Html::encode($this->title) ?></title>

		<?php $this->head() ?>

		<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap" rel="stylesheet" />
	</head>
	<body>
	<?php $this->beginBody() ?>

	<?= Alert::widget() ?>

	<?= $content ?>

	<?php if (!isset($this->blocks['hideNavigationBar'])): ?>
		<section>
			<nav class="navigationBar">
				<ul>
					<li>
						<a href="">
							<img src="<?= Yii::getAlias('@web') ?>/images/paradam/discover.svg" alt="">
						</a>
					</li>
					<li>
						<a href="">
							<img src="<?= Yii::getAlias('@web') ?>/images/paradam/search.svg" alt="">
						</a>
					</li>
					<li>
						<a href="">
							<img src="<?= Yii::getAlias('@web') ?>/images/paradam/messages.svg" alt="">
						</a>
					</li>
					<li>
						<a href="">
							<img src="<?= Yii::getAlias('@web') ?>/images/paradam/notification.svg" alt="">
						</a>
					</li>
				</ul>
			</nav>
		</section>
	<?php endif; ?>
	<?php $this->endBody() ?>
	</body>
	</html>
<?php $this->endPage() ?>