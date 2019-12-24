<?php
	/**
	 * @var $content
	 */
	
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\helpers\Html;


?>
<?php $this->beginPage(); ?>
    <!doctype html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		
		<?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
		<?php $this->head(); ?>
    </head>
    <body>
	<?php $this->beginBody(); ?>
	<?php
		NavBar::begin([
			'brandLabel' => 'Paradam',
			'brandUrl' => Yii::$app->homeUrl,
			'options' => [
				'class' => 'navbar-default navbar-fixed-top'
			]
		]);
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
				['label' => 'Home', 'url' => ['/']],
				['label' => 'Join', 'url' => ['/user/join']],
				Yii::$app->user->isGuest ? (
				['label' => 'Login', 'url' => ['/user/login']]
				) : (
					'<li>'
					. Html::beginForm(['/site/logout'], 'post')
					. Html::submitButton(
						'Logout (' . Yii::$app->user->identity->username . ')',
						['class' => 'btn btn-link logout']
					)
					. Html::endForm()
					. '</li>'
				)
			],
		]);
		NavBar::end();
	?>
    <div class="container" style="margin-top:80px;min-height: calc(85vh - 60px);">
		<?= $content; ?>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
	<?php $this->endBody(); ?>
    </body>
    </html>
<?php $this->endPage(); ?>