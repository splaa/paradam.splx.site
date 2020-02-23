<?php

	use yii\helpers\Html;

	/* @var $this yii\web\View */
	/* @var $model app\modules\services\models\Service */

	$this->title = Yii::t('app', 'Update Service: {name}', [
		'name' => $model->name,
	]);
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
	$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="service-update">

    <div class="box">
        <div class="box-body">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
        </div>
    </div>
</div>


<div>
    <h3>Вопросы</h3>
    <div class="box">
        <div class="box-body">
	<?php
		$form = \yii\bootstrap\ActiveForm::begin()
	?>
	<?php foreach ($model->questions as $questions): ?>

		<?= $form->field($questions, 'question'); ?>


	<?php endforeach; ?>
	<?php \yii\bootstrap\ActiveForm::end(); ?>
        </div>
    </div>
</div>