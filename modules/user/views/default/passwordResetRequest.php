<?php

// Default (Template) Project/${FILE_NAME}

/* @var $this \yii\web\View */

/* @var $model \app\modules\user\models\PasswordResetRequestForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please choose your new password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
			
			<?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

            <div class="form-group">
				<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
			
			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
