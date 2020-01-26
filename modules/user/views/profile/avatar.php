<?php

use yii\widgets\ActiveForm;

?>

<img src="<?= Yii::$app->user->identity->getAvatarBig() ?>" alt="<?= Yii::$app->user->identity->alt ?>" />

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

	<button>Отправить</button>

<?php ActiveForm::end() ?>