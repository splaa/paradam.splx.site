<?php
/**
 * @var \app\modules\message\models\UserThread $selected_user_thread
 * @var \yii\web\View $this
 * @var integer $froze
 */

use app\modules\services\models\OrderService;
use app\modules\user\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$host = Yii::$app->request->hostInfo;
$user_id = Yii::$app->user->id;
$avatar = Yii::$app->user->identity->avatarSmall;
$alt = Yii::$app->user->identity->alt;
$time = date("Y-m-m H:i:s");

?>

<div class="msg_history">
	<?php foreach ($selected_user_thread->thread->messages as $message): ?>
		<?php if ($message->author_id != Yii::$app->user->id): ?>
			<div class="incoming_msg">
				<div class="incoming_msg_img">
					<img src="<?= $message->author->getAvatarSmall() ?>" alt="<?= $message->author->alt ?>">
				</div>
				<div class="received_msg">
					<div class="received_withd_msg">
						<?php if ($message->cancel): ?>
							<span class="service__finish reason_cancel"><b>Причина отказа:</b></span>
						<?php endif; ?>
						<p>
							<?php if ($message->text && $message->audio): ?>
								<?= $message->text ?>
								<audio controls="" src="<?= Yii::$app->request->hostInfo ?>/uploads/messages/<?= $message->audio ?>"></audio>
							<?php elseif ($message->audio): ?>
								<audio controls="" src="<?= Yii::$app->request->hostInfo ?>/uploads/messages/<?= $message->audio ?>"></audio>
							<?php else: ?>
								<?= $message->text ?>
							<?php endif; ?>

							<?php if (!empty($message->orderService)): ?>
								<?php if ($message->orderService->status == 0): ?>
									<span class="service__button">
										<button type="button" class="btn btn-success" onclick="confirmTask(this, <?= $message->order_service_id ?>, 1, '<?= Url::to(['confirm-task']) ?>');">Задание выполнено</button>
										<button type="button" class="btn btn-danger" onclick="confirmTask(this, <?= $message->order_service_id ?>, 2, '<?= Url::to(['confirm-task']) ?>');">Отказаться от задания</button>
									</span>
									<span class="service__time"></span>
								<?php else: ?>
									<span class="service__finish">
										<b><?= OrderService::getStatusByType($message->orderService->status) ?></b>
									</span>
								<?php endif; ?>
							<?php elseif($message->order_service_id): ?>
								<span class="service__finish">
									<b><?= OrderService::getStatusByType() ?></b>
								</span>
							<?php endif; ?>
						</p>
						<span class="time_date"> <?= Yii::$app->formatter->asRelativeTime($message->created_at ) ?>    |    <?= Yii::$app->formatter->asDate($message->created_at ) ?></span>
					</div>
				</div>
			</div>
		<?php else: ?>
			<div class="outgoing_msg">
				<div class="sent_msg">
					<?php if ($message->cancel): ?>
						<span class="service__finish reason_cancel"><b>Причина отказа:</b></span>
					<?php endif; ?>
					<p>
						<?php if ($message->text && $message->audio): ?>
							<?= $message->text ?>
							<audio controls="" src="<?= Yii::$app->request->hostInfo ?>/uploads/messages/<?= $message->audio ?>"></audio>
						<?php elseif ($message->audio): ?>
							<audio controls="" src="<?= Yii::$app->request->hostInfo ?>/uploads/messages/<?= $message->audio ?>"></audio>
						<?php else: ?>
							<?= $message->text ?>
						<?php endif; ?>

						<?php if (!empty($message->orderService)): ?>
							<?php if ($message->orderService->status == 1): ?>
								<span class="service__button">
									<b><?= OrderService::getStatusByType($message->orderService->status) ?></b>

									<button type="button" class="btn btn-success" onclick="confirmTask(this, <?= $message->order_service_id ?>, 3, '<?= Url::to(['confirm-task']) ?>');">Подтвердить выполнение</button>
									<button type="button" class="btn btn-danger" onclick="confirmTask(this, <?= $message->order_service_id ?>, 4, '<?= Url::to(['confirm-task']) ?>');">Открыть Диспут</button>
								</span>
							<?php else: ?>
								<span class="service__finish">
									<b><?= OrderService::getStatusByType($message->orderService->status) ?></b>
								</span>
							<?php endif; ?>
						<?php elseif($message->order_service_id): ?>
							<span class="service__finish">
								<b><?= OrderService::getStatusByType() ?></b>
							</span>
						<?php endif; ?>
					</p>
					<span class="time_date"> <?= Yii::$app->formatter->asRelativeTime($message->created_at ) ?>    |    <?= Yii::$app->formatter->asDate($message->created_at ) ?></span>
				</div>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
<?php if ($selected_user_thread->thread->creator_id == $user_id && $froze): ?>
	<?php if ($selected_user_thread->thread->message->order_service_id): ?>
		<div class="">
			<p>Вы получаете: <?= $selected_user_thread->thread->message->orderService->service->formatPrice ?></p>
			<p>Время на выполнение: <?= $selected_user_thread->thread->message->orderService->service->periodOfExecution ?>д.</p>
		</div>
	<?php else: ?>
		<div class="">
			<p>Вы получаете: <?= Yii::$app->user->identity->formatSmsCostPercent ?></p>
			<p>Время на выполнение: <?= User::MESSAGE_LIVE_TIME ?>д.</p>
		</div>
	<?php endif; ?>
	<div class="button-message-confirm">
		<?= Html::button('Ответить', ['class' => 'confirm_message', 'data-confirm_message' => 1]) ?>
		<?= Html::button('Отказаться', ['class' => 'confirm_message', 'data-confirm_message' => 0]) ?>
	</div>
<?php endif; ?>
<div class="type_msg <?= ($selected_user_thread->thread->creator_id == $user_id && $froze) ? 'hide' : '' ?>">
	<div class="input_msg_write">
		<input type="text" class="write_msg" placeholder="Type a message"/>
		<input type="hidden" class="audio_msg"/>
		<button class="msg_send_btn record-btn" id="recordButton" type="button"><i class="glyphicon glyphicon-record"aria-hidden="true"></i></button>
		<button class="msg_send_btn" type="button"><i class="glyphicon glyphicon-send"aria-hidden="true"></i></button>
	</div>
	<p><strong>Timing: <span>30sec = 100bits</span>/<span id="record_time">0</span> = <span id="record_bits">0 bits</span></strong></p>
	<p><strong>Recordings:</strong></p>
	<div id="recordingsList"></div>
</div>

<script>
	let WS_HOST = '<?= Yii::$app->params['ws_host'] ?>';
	let upload_file = '<?= Url::to(['message/upload-audio']) ?>';
	let sendingData = {
        message: '',
        audio: '',
        timing: '',
		cancel: 0,
        user_id: '<?= $user_id ?>',
        thread_id: '<?= $selected_user_thread->thread_id ?>',
        avatar: '<?= $avatar ?>',
        alt: '<?= $alt ?>',
        time: '<?= $time ?>',
        date: '<?= $time ?>'
    };
	let systemData = {
        host: '<?= $host ?>',
        user_id: '<?= $user_id ?>',
        avatar: '<?= $avatar ?>',
        alt: '<?= $alt ?>',
        time: '<?= $time ?>',
        thread_id: '<?= $selected_user_thread->thread_id ?>',
		creator_id: '<?= $selected_user_thread->thread->creator_id ?>'
    };
</script>