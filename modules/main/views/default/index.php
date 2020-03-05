<?php
	
	/* @var $this yii\web\View */
	
	$this->title = Yii::$app->name;

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar; ?>
<div class="main-default-index">
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
			Yii::$app->user->isGuest ?
				['label' => Yii::t('app', 'NAV_SIGNUP'), 'url' => ['/user/phoneidentity/index']] :
				false,
			Yii::$app->user->isGuest ?
				['label' => Yii::t('app', 'NAV_LOGIN'), 'url' => ['/user/default/phonelogin']] :
				false,
			!Yii::$app->user->isGuest ?
				['label' => Yii::t('app', 'NAV_ADMIN'), 'items' => [
					['label' => Yii::t('app', 'NAV_ADMIN'), 'url' => ['/admin/default/index']],
					['label' => Yii::t('app', 'NAV_SERVICES'), 'url' => ['/services/service']],
					['label' => Yii::t('app', 'NAV_QUESTIONS'), 'url' => ['/services/question']],
					['label' => Yii::t('app', 'ADMIN_USERS'), 'url' => ['/admin/users/index']],
					['label' => Yii::t('app', 'ADMIN_THREAD'), 'url' => ['/admin/thread/index']],
					['label' => Yii::t('app', 'ADMIN_ORDERS'), 'url' => ['/admin/order-service/index']],
				]] :
				false,
			!Yii::$app->user->isGuest ?
				['label' => Yii::t('app', 'NAV_PROFILE'), 'items' => [
					['label' => Yii::t('app', 'NAV_PROFILE'), 'url' => ['/user/profile/index']],
					['label' => sprintf(Yii::t('app', 'NAV_PROFILE_BALANCE'), Yii::$app->user->identity->formatBalance, Yii::$app->user->identity->convertBalanceToUSD), 'url' => ['/user/profile/balance']],
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
    <div class="jumbotron">
        <h1><?= Yii::t('app', 'Congratulations') ?>!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a>
                </p>
            </div>
        </div>

    </div>
</div>
