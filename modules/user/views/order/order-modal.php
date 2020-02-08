<?php
	/**
	 * @var $service \app\modules\services\models\Service
	 * @var $user_id integer
	 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Услуги";
	Yii::$app->params['modalTitle'] = 'Услуги'
?>

<?php if (!empty($service)): ?>
	<form action="<?= Url::to(['order/save']) ?>" id="send_service_form">
	    <div class="table-responsive-lg">
		    <?php if ($service->link_foto_video_file): ?>
		        <p><?= Html::img('@web/images/services/uploads/' . $service->link_foto_video_file, ['width' => '50px']) ?></p>
		    <?php endif; ?>
		    <p>Имя: <?= $service->name; ?></p>
		    <p>Price: <?= $service->formatPrice; ?> - <?= $service->convertPriceToUSD ?></p>
		    <p>Ответить на Вопросы:</p>
	        <ul>
		        <?php foreach ($service->questions as $question): ?>
		            <li>
			            <div>
			                <b><?= $question->question ?></b>
			            </div>
			            <div class="form-group">
				            <input type="text" name="answered[<?= $service->id ?>][<?= $question->id ?>]" placeholder="" value="" class="form-control req" data-error="Обязательно для заполнения" />
			            </div>
		            </li>
		        <?php endforeach; ?>
	        </ul>
	    </div>
		<div class="form-group">
			<label for="comment">Ваш Коментарий</label>
			<textarea name="comment" id="comment" rows="5" class="form-control"></textarea>
		</div>
		<div class="form-group clearfix">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="terms_of_use" value="1" checked> Согласен с пользовательским соглашением
				</label>
			</div>
		</div>
		<input type="hidden" value="<?= $user_id ?>" name="user_id" />
	</form>
<?php else: ?>
    <h3>Пусто</h3>
<?php endif; ?>


