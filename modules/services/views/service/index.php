<?php
	
	use yii\grid\GridView;
	use yii\helpers\Html;
	use yii\widgets\Pjax;
	
	/* @var $this yii\web\View */
/* @var $searchModel app\modules\services\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Service'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
	
	        //      'id',
	        //      'user_id',
            'name',
            'description:ntext',
            'price',
            //'periodOfExecution',
            //'link_foto_video_file',
            //'created_at',
            //'updated_at',
	
	        ['class' => 'app\components\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
