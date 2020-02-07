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

    <h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>


<div>
    <h2>Вопросы</h2>

	<?php
		$form = \yii\bootstrap\ActiveForm::begin()
	?>
	<?php foreach ($model->questions as $questions): ?>

		<?= $form->field($questions, 'question'); ?>


	<?php endforeach; ?>
	<?php \yii\bootstrap\ActiveForm::end(); ?>
    </tr>
    </tbody>
    </table>
</div>