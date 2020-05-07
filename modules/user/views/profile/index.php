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
		<?= Html::a(Yii::t('app', 'LINK_TO_PHONE_CHANGE'), ['telephone-change'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'LINK_TO_MESSAGES'), ['/message/message/index'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'LINK_TO_AVATAR'), ['upload-avatar'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'LINK_TO_COVER'), ['upload-cover'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'LINK_TO_MESSAGE_SETTINGS'), ['/message/message/settings'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(sprintf(Yii::t('app', 'NAV_PROFILE_BALANCE'), Yii::$app->user->identity->formatBalance, Yii::$app->user->identity->convertBalanceToUSD), ['balance'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(sprintf(Yii::t('app', 'NAV_PROFILE_CHANGE_NAME'), Yii::$app->user->identity->formatBalance), ['name-change'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(sprintf(Yii::t('app', 'NAV_PROFILE_CHANGE_USER_NAME'), Yii::$app->user->identity->formatBalance), ['user-name-change'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(sprintf(Yii::t('app', 'NAV_PROFILE_CHANGE_DATE'), Yii::$app->user->identity->formatBalance), ['date-change'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'LINK_TO_DESCRIPTION_CHANGE'), ['description-change'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'LINK_TO_LINK_CHANGE'), ['link-change'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'NAV_SERVICES'), ['/services/service'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'NAV_QUESTIONS'), ['/services/question'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'LINK_TO_LINK_ADD_LANGUAGES'), ['add-languages'], ['class' => 'btn btn-primary']) ?>
    </p>
	<?php
		//var_dump($model);
	?>


	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'username',
			[
				'label' => 'електронный адрес',
				'attribute' => 'email',
			],
			[
				'attribute' => 'first_name',
				'label' => 'Услуги',
				'format' => 'raw',
				'value' => function ($data) {
					return '<a href="/services/service">Услуги</a>';
				}
			],
			'telephone',
			'balance',
			[
				'attribute' => 'status',
				'format' => 'raw',
				'value' => function ($data) {
					return $data->status ? '<span class="text-success">Активный</span>' : '<span class="text-danger">Не Активный</span>';
				}
			],
		],
	]) ?>

</div>