<?php
// paradam.me.loc/ProfileController.php

namespace app\modules\user\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class UserController extends Controller
{
	public function behaviors()
	{
		return [
			'access' =>[
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' =>true,
						'roles' =>['@']
					],
				],
			],
		];
	}
}