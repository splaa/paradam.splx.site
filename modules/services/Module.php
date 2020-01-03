<?php
	
	namespace app\modules\services;
	
	use Yii;
	
	/**
	 * services module definition class
	 */
	class Module extends \yii\base\Module
	{
		/**
		 * {@inheritdoc}
		 */
		public $controllerNamespace = 'app\modules\services\controllers';
		
		/**
		 * {@inheritdoc}
		 */
		public function init()
		{
			parent::init();
			
			// custom initialization code goes here
		}
		
		public static function t($category, $message, $params = [], $language = null)
		{
			return Yii::t('modules/user/' . $category, $message, $params, $language);
		}
	}
