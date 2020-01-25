<?php
	// paradam.me.loc/index.php
	
	
	use yii\helpers\Html;
	use yii\widgets\DetailView;
	
	/* @var $this yii\web\View */
	/* @var $model app\modules\user\models\User */
	
	$this->title = Yii::t('app', 'TITLE_PROFILE');
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
		<?= Html::a(Yii::t('app', 'BUTTON_UPDATE'), ['update'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'LINK_PASSWORD_CHANGE'), ['password-change'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'LINK_TO_PHONE_CHANGE'), ['/message/settings/'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'LINK_TO_MESSAGES'), ['/message/'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'LINK_TO_AVATAR'), ['upload-avatar'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'LINK_TO_MESSAGE_SETTINGS'), ['/message/settings/'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(sprintf(Yii::t('app', 'NAV_PROFILE_BALANCE'), Yii::$app->user->identity->formatBalance), ['/user/profile/balance'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(sprintf(Yii::t('app', 'NAV_PROFILE_CHANGE_NAME'), Yii::$app->user->identity->formatBalance), ['/user/profile/name-change'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(sprintf(Yii::t('app', 'NAV_PROFILE_CHANGE_USER_NAME'), Yii::$app->user->identity->formatBalance), ['/user/profile/user-name-change'], ['class' => 'btn btn-primary']) ?>
    </p>
	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'username',
			'email',
		],
	]) ?>

</div>