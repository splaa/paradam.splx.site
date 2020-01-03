<?php
	// paradam.me.loc/Bootstrap.php
	namespace app\modules\main;
	
	use yii\base\BootstrapInterface;
	
	class Bootstrap implements BootstrapInterface
	{
		public function bootstrap($app)
		{
			$app->i18n->translations['modules/user/*'] = [
				'class' => 'yii\i18n\PhpMessageSource',
				'forceTranslation' => true,
				'basePath' => '@app/modules/user/messages',
				'fileMap' => [
					'modules/user/module' => 'module.php',
				],
			];
		}
	}