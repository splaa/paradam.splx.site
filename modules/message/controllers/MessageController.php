<?php

namespace app\modules\message\controllers;

use app\modules\message\models\UserThread;
use app\modules\user\controllers\UserController;
use Yii;
use \app\components\Hash;
use YoHang88\LetterAvatar\LetterAvatar;

/**
 * Default controller for the `message` module
 */
class MessageController extends UserController
{
	/**
	 * @param string $id
	 * @return string
	 * @throws \yii\base\InvalidConfigException
	 */
	public function actionIndex($id = '')
	{
		$this->view->registerCssFile('@web/css/chat.css');

		$threads = UserThread::find()
			->where(['user_id' => Yii::$app->user->getId()])
			->orderBy(['id' => SORT_DESC])
			->all();
		$selected_user_thread = [];

		if ($id) {
			// Decode Hash
			$hash = new Hash();
			$hash->string = $id;

			$selected_user_thread = UserThread::find()
				->where(['thread_id' =>  $hash->run(Hash::DECODE)])
				->andWhere(['user_id' => Yii::$app->user->getId()])
				->one();
		}
		
		return $this->render('index', [
			'threads' => $threads,
			'selected_user_thread' => $selected_user_thread
		]);
	}
}
