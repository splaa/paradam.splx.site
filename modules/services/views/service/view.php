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
		<?= Html::a(Yii::t('app', 'SET_QUESTION_SERVICE'), ['/services/question/add-question', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
		<?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
				'method' => 'post',
			],
		]) ?>
    </p>
    <div class="box">
        <div class="box-body">
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
        </div>
    </div>
    <!--    // Todo-splaa: Реализовать загрузку картинки с изображением (отображением картинки)-->
    <!--    // Review-Serik: Проверить код-->
    <!--	Review-[splx] -->
    <div>
        <h2>Вопросы</h2>
        <div class="box">
            <div class="box-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Вопрос</th>
                <th scope="col">статус</th>

            </tr>
            </thead>
            <tbody>
            <tr>
				<?php
					$i = 0;
				?>
				<?php foreach ($model->questions as $questions): ?>
            <tr>
                <th scope="row"><?= $i += 1 ?></th>
                <td><?= $questions->id ?></td>
                <td><?= $questions->question ?></td>
                <td><?= $questions->status ?></td>
            </tr>
			<?php endforeach; ?>
            </tr>
            </tbody>
        </table>
            </div>
        </div>
    </div>

</div>
