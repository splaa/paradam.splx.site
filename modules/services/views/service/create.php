<?php

	use yii\helpers\Html;

	/* @var $this yii\web\View */
	/* @var $model app\modules\services\models\Service */

	$this->title = Yii::t('app', 'Create Service');
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="box">
        <div class="box-body">
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>
        </div>
    </div>
</div>
