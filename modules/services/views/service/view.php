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
    <div class="row">
        <div class="col-md-12">
            <?= Html::a(Yii::t('app', 'Add Image'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>

        </div>
        <div class="col-md-12">
            <?php if (!empty($model->imageFile)) {
                echo Html::img($model->imageFile, $options = ['class' => 'postImg', 'style' => ['width' => '180px']]);
                echo Html::img('@web/uploads/Снимок экрана 2020-01-23 в 12.06.54 ДП.png', ['width' => '150px']);
            } ?>
        </div>
    </div>
</div>
