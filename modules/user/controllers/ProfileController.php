<?php
// paradam.me.loc/ProfileController.php

	namespace app\modules\user\controllers;


	use app\modules\admin\models\User;
	use app\modules\user\forms\PasswordChangeForm;
	use app\modules\user\forms\ProfileUpdateForm;
	use app\modules\user\forms\UploadAvatar;
	use yii\imagine\Image;
	use Yii;
	use yii\filters\AccessControl;
	use yii\web\Controller;
	use yii\web\UploadedFile;

	class ProfileController extends UserController
	{
		public function actionIndex()
		{
			return $this->render('index', [
				'model' => $this->findModel(),
			]);
		}
		
		private function findModel()
		{
			return User::findOne(Yii::$app->user->identity->getId());
		}
		
		
		public function actionUpdate()
		{
			$user = $this->findModel();
			$model = new ProfileUpdateForm($user);
			
			if ($model->load(Yii::$app->request->post()) && $model->update()) {
				return $this->redirect(['index']);
			} else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		}
		
		public function actionPasswordChange()
		{
			$user = $this->findModel();
			$model = new PasswordChangeForm($user);
			
			if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
				return $this->redirect(['index']);
			} else {
				return $this->render('passwordChange', [
					'model' => $model,
				]);
			}
		}

		public function actionUploadAvatar()
		{
			$model = new UploadAvatar();

			if (Yii::$app->request->isPost) {
				$model->file = UploadedFile::getInstance($model, 'file');

				if ($model->file && $model->validate()) {
					$model->file->saveAs('images/user/avatar/' . Yii::$app->user->identity->username . '-temp.' . $model->file->extension);
					// Generate Small Avatar
					Image::thumbnail('images/user/avatar/' . Yii::$app->user->identity->username . '-temp.' . $model->file->extension, User::SIZE_AVATAR_SMALL, User::SIZE_AVATAR_SMALL)
						->save('images/user/avatar/' . Yii::$app->user->identity->username . '-' . User::SIZE_AVATAR_SMALL . '.png');
					// Generate Medium Avatar
					Image::thumbnail('images/user/avatar/' . Yii::$app->user->identity->username . '-temp.' . $model->file->extension, User::SIZE_AVATAR_MEDIUM, User::SIZE_AVATAR_MEDIUM)
						->save('images/user/avatar/' . Yii::$app->user->identity->username . '-' . User::SIZE_AVATAR_MEDIUM . '.png');
					// Generate Big Avatar
					Image::thumbnail('images/user/avatar/' . Yii::$app->user->identity->username . '-temp.' . $model->file->extension, User::SIZE_AVATAR_BIG, User::SIZE_AVATAR_BIG)
						->save('images/user/avatar/' . Yii::$app->user->identity->username . '-' . User::SIZE_AVATAR_BIG . '.png');

					unlink('images/user/avatar/' . Yii::$app->user->identity->username . '-temp.' . $model->file->extension);
				}
			}

			return $this->render('avatar', [
				'model' => $model
			]);
		}
		
		
	}