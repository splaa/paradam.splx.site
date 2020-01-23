<?php
	
	/* @var $this \yii\web\View */
	
	/* @var $content string */
	
	use app\assets\AppAsset;
use app\modules\user\models\User;
use app\widgets\Alert;
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\helpers\Html;
	use yii\widgets\Breadcrumbs;
	
	AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
	<?php
		NavBar::begin([
			'brandLabel' => Yii::$app->name,
			'brandUrl' => Yii::$app->homeUrl,
			'options' => [
				'class' => 'navbar-inverse navbar-fixed-top',
			],
		]);
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'activateParents' => true,
			'items' => array_filter([
				['label' => Yii::t('app', 'NAV_HOME'), 'url' => ['/main/default/index']],
				['label' => Yii::t('app', 'NAV_USERS'), 'url' => ['/user/public/list']],
				['label' => Yii::t('app', 'NAV_CONTACT'), 'url' => ['/main/contact/index']],
				Yii::$app->user->isGuest ?
					['label' => Yii::t('app', 'NAV_SIGNUP'), 'url' => ['/user/phoneidentity/index']] :
					false,
				Yii::$app->user->isGuest ?
					['label' => Yii::t('app', 'NAV_LOGIN'), 'url' => ['/user/default/phonelogin']] :
					false,
				!Yii::$app->user->isGuest ?
					['label' => Yii::t('app', 'NAV_ADMIN'), 'items' => [
						['label' => Yii::t('app', 'NAV_ADMIN'), 'url' => ['/admin/default/index']],
						['label' => Yii::t('app', 'ADMIN_USERS'), 'url' => ['/admin/users/index']],
					]] :
					false,
				!Yii::$app->user->isGuest ?
					['label' => sprintf(Yii::t('app', 'NAV_PROFILE'), Yii::$app->user->identity->balance . ' ' . User::CURRENCY_BIT), 'items' => [
						['label' => sprintf(Yii::t('app', 'NAV_PROFILE'), Yii::$app->user->identity->balance . ' ' . User::CURRENCY_BIT), 'url' => ['/user/profile/index']],
						['label' => Yii::t('app', 'NAV_LOGOUT'),
							'url' => ['/user/default/logout'],
							'linkOptions' => ['data-method' => 'post']]
					]] :
					false,
				Yii::$app->user->can('admin') ?
					['label' => Yii::t('app', 'NAV_ADMIN'), 'items' => [
						['label' => Yii::t('app', 'NAV_ADMIN'), 'url' => ['/admin/default/index']],
						['label' => Yii::t('app', 'ADMIN_USERS'), 'url' => ['/admin/users/index']],
					]] :
					false,
				Yii::$app->language === 'en' ?
					['label' => Yii::t('app', 'Русский'), 'url' => ['/', 'language' => 'ru']] :
					false,
				Yii::$app->language === 'ru' ?
					['label' => Yii::t('app', 'English'), 'url' => ['/', 'language' => 'en']] :
					false,
			
			
			]),
		]);
		NavBar::end();
	?>

    <div class="container">
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<?= Alert::widget() ?>
		<?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>
        <p class="pull-right"><?= date('Y-m-d') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
