<?php

use app\components\widgets\menu\MenuWidget;
use yii\widgets\ActiveForm;

?>


<!-- HEADER -->
<header class="flex-center">
	<span class="profileButton">
	    <img src="<?= Yii::getAlias('@web') ?>/images/paradam/user.svg" alt="">
	</span>
	<h2>Изменить Обложку</h2>
	<input type="checkbox" id="nav-toggle" hidden>

	<?= MenuWidget::widget() ?>
</header>
<!-- HEADER FIN -->

<section>
	<div class="mainContainer"
		<div class="user-form">
			<img src="<?= Yii::$app->user->identity->cover ?>" alt="<?= Yii::$app->user->identity->alt ?>" />

			<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

			<?= $form->field($model, 'file')->fileInput() ?>

			<button>Отправить</button>

			<?php ActiveForm::end() ?>
		</div>
	</div>
</section>
