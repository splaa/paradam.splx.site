<?php

use app\components\widgets\menu\MenuWidget;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<!-- HEADER -->
<header class="flex-center">
    <span class="profileButton">
        <img src="<?= Yii::getAlias('@web') ?>/images/paradam/user.svg" alt="">
    </span>
	<h2>Список пользователей</h2>
	<input type="checkbox" id="nav-toggle" hidden>

	<?= MenuWidget::widget() ?>
</header>
<!-- HEADER FIN -->

<section>
	<div class="mainContainer">
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'columns' => [
				[
					'attribute' => 'username',
					'format' => 'raw',
					'value' => function($data) {
						return Html::a($data->username, ['public/', 'username' => $data->username]);
					}
				],
			],
		]) ?>
		<p>&nbsp;<br><br></p>
	</div>
</section>
