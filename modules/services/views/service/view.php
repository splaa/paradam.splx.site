<?php

	use yii\helpers\Html;
	use yii\widgets\DetailView;

	/* @var $this yii\web\View */
	/* @var $model app\modules\services\models\Service */

	$this->title = $model->name;
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
	\yii\web\YiiAsset::register($this);
?>
<div class="service-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'SET_IMAGE_SERVICE'), ['set-image', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('app', 'SET_QUESTION_SERVICE'), ['/services/question/create', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
		<?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
				'method' => 'post',
			],
		]) ?>
    </p>

	<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'name',
            'description:ntext',
            'price',
            'periodOfExecution',
            'link_foto_video_file',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <!--    // Todo-splaa: Реализовать загрузку картинки с изображением (отображением картинки)-->

</div>
