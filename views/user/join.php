<?php
	// paradam.me.loc/join.php
	
	/**
	 * @var UserJoinForm $userJoinForm
	 */
	
	use app\models\user\UserJoinForm;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3>Join us</h3>
    </div>
    <div class="panel-body">
	
	    <?php $form = ActiveForm::begin(['id' => 'user-join-form']); ?>
	    <?= $form->field($userJoinForm, 'name') ?>
	    <?= $form->field($userJoinForm, 'email') ?>
	    <?= $form->field($userJoinForm, 'password')->passwordInput() ?>
	    <?= $form->field($userJoinForm, 'password2')->passwordInput() ?>
	    <?= Html::submitButton('Create', ['class' => 'btn btn-danger']) ?>
	    <?php ActiveForm::end(); ?>
    </div>
</div>