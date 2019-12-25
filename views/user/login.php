<?php
	// paradam.me.loc/login.php
	
	/**
	 * @var $userLoginForm UserLoginForm
	 */
	
	use app\models\user\UserLoginForm;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

?>


<div class="panel panel-success">
    <div class="panel-heading">
        <h1>Log in</h1>
    </div>
    <div class="panel-body">
	    <?php $form = ActiveForm::begin(['id' => 'user-login-form']); ?>
	    <?= $form->field($userLoginForm, 'email') ?>
	    <?= $form->field($userLoginForm, 'password')->passwordInput() ?>
	    <?= Html::submitButton('Enter') ?>
	    <?php ActiveForm::end() ?>
    </div>
</div>

