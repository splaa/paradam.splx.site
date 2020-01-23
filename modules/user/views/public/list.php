<?php

use app\components\grid\LinkColumn;
use app\modules\admin\components\SetColumn;
use app\modules\admin\models\User;
use kartik\date\DatePicker;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="user-index">

	<h1>Список пользователей</h1>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			[
				'attribute' => 'username',
				'format' => 'raw',
				'value' => function($data) {
					return Html::a($data->username, ['public/', 'id' => $data->id]);
				}
			],
		],
	]) ?>


</div>
