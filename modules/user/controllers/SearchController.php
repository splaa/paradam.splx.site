<?php


namespace app\modules\user\controllers;


use app\modules\user\models\User;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;

class SearchController extends UserController
{
	public function actionIndex($q = null) {
		try {
			$users = User::find()
				->select(['id', 'username as value', 'CONCAT(first_name, " ", last_name) as full_name'])
				->filterWhere(['like', 'username', $q])
				->orfilterWhere(['like', 'CONCAT(first_name, " ", last_name)', $q])
				->andFilterWhere(['status' => User::STATUS_ACTIVE])
				->limit(50)
				->asArray()
				->all();

			foreach ($users as $key => $user) {
				$path_to_file = Yii::getAlias( '@web' ).'images/user/avatar/' . $user['id'] . '-' . User::SIZE_AVATAR_SMALL . '.png';
				if(file_exists($path_to_file)){
					$avatar = Yii::$app->request->hostInfo . '/images/user/avatar/' . $user['id'] . '-' . User::SIZE_AVATAR_SMALL . '.png';
				} else {
					$avatar = Yii::$app->request->hostInfo . '/images/user/avatar/none.png';
				}

				$users[$key]['avatar'] = $avatar;
				$users[$key]['link'] = Url::to(['public/', 'username' => $user['value']]);
			}
		} catch (InvalidConfigException $e) {
			$users = [];
		}

		return Json::encode($users);
	}
}