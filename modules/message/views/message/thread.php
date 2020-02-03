<?php
/**
 * @var \app\modules\message\models\UserThread $selected_user_thread
 * @var \yii\web\View $this
 */

use yii\helpers\Url;
use yii\web\View;

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
						<p>
							<?php if ($message->audio): ?>
								<audio controls="" src="<?= Yii::$app->request->hostInfo ?>/uploads/messages/<?= $message->audio ?>"></audio>
							<?php else: ?>
								<?= $message->text ?>
							<?php endif; ?>
						</p>
						<span class="time_date"> <?= Yii::$app->formatter->asRelativeTime($message->created_at ) ?>    |    <?= Yii::$app->formatter->asDate($message->created_at ) ?></span>
					</div>
				</div>
			</div>
		<?php else: ?>
			<div class="outgoing_msg">
				<div class="sent_msg">
					<p>
						<?php if ($message->audio): ?>
							<audio controls="" src="<?= Yii::$app->request->hostInfo ?>/uploads/messages/<?= $message->audio ?>"></audio>
						<?php else: ?>
							<?= $message->text ?>
						<?php endif; ?>
					</p>
					<span class="time_date"> <?= Yii::$app->formatter->asRelativeTime($message->created_at ) ?>    |    <?= Yii::$app->formatter->asDate($message->created_at ) ?></span>
				</div>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
<div class="type_msg">
	<div class="input_msg_write">
		<input type="text" class="write_msg" placeholder="Type a message"/>
		<input type="hidden" class="audio_msg"/>
		<button class="msg_send_btn record-btn" id="recordButton" type="button"><i class="glyphicon glyphicon-record"aria-hidden="true"></i></button>
		<button class="msg_send_btn" type="button"><i class="glyphicon glyphicon-send"aria-hidden="true"></i></button>
	</div>
	<p><strong>Recordings:</strong></p>
	<div id="recordingsList"></div>
</div>

<?php
	$host = Yii::$app->request->hostInfo;
	$user_id = Yii::$app->user->id;
	$avatar = Yii::$app->user->identity->avatarSmall;
	$alt = Yii::$app->user->identity->alt;
	$time = date("Y-m-m H:i:s");
?>
<script>
	let upload_file = '<?= Url::to(['message/upload-audio']) ?>';
	let sendingData = {
        message: '',
        audio: '',
        user_id: '<?= $user_id ?>',
        thread_id: '<?= $selected_user_thread->thread_id ?>',
        avatar: '<?= $avatar ?>',
        alt: '<?= $alt ?>',
        time: '<?= $time ?>',
        date: '<?= $time ?>',
    };
</script>
<?php
$JS = <<<JS
	function message(data, me) {
	    let html = '';
	    if (me) {
			html += '<div class="outgoing_msg">';
				html += '<div class="sent_msg">';
					if (data.audio) {
						html += '<p><audio controls="" src="{$host}/uploads/messages/' + data.audio + '"></audio></p>';
					} else {
					    html += '<p>' + data.message + '</p>';
					}
					html += '<span class="time_date"> ' + data.time + '    |    ' + data.date + '</span>';
				html += '</div>';
			html += '</div>';
		} else {
			html += '<div class="incoming_msg">';
				html += '<div class="incoming_msg_img">';
					html += '<img src="' + data.avatar + '"  alt="' +  data.alt + '">';
				html += '</div>';
				html += '<div class="received_msg">';
					html += '<div class="received_withd_msg">';
						if (data.audio) {
							html += '<p><audio controls="" src="{$host}/uploads/messages/' + data.audio + '"></audio></p>';
						} else {
						    html += '<p>' + data.message + '</p>';
						}
						html += '<span class="time_date"> ' + data.time + '    |    ' + data.date + '</span>';
					html += '</div>';
				html += '</div>';
			html += '</div>';
		}
	    
	    $('.msg_history').append(html);
	    
	    $('.msg_history').scrollTop($('.msg_history')[0].scrollHeight);
	}
	
	function send() {
		sendingData.message = $('.write_msg').val();

        if (sendingData.message || sendingData.audio) {
        	socket.send(JSON.stringify(sendingData));
            $('#recordingsList').html('');
            $(".write_msg").val("");

            sendingData.message = '';
            sendingData.audio = '';
        }
	}

	socket.onmessage = function(e) {
	    // e.data - данные
	    let data = JSON.parse(e.data);

	    if (data.thread_id == '{$selected_user_thread->thread_id}') {
		    if (data.user_id == '{$user_id}') {
	            message(data, true);
	        } else {
		        message(data, false);
	        }
	    }

	    $('#thread_' + data.thread_id).find('p > .text').html(data.message);

	    if (data.user_id != '{$user_id}') {
	        $('#thread_' + data.thread_id).find('p > .badge').html(1);
	    }
	};

	socket.onclose = function(e) {
	    if (e.wasClean) {
	        // Соиденение закрыто
	    } else {
	        // Соиденение как-то закрыто
	    }
	    
	    // e.code - e.reason - причина и код ошибки
	};
	
	socket.onerror = function (e) {
	     // e.message - ошибка
	};
	
	$(".msg_send_btn").on('click',function() {
		send();

        return false;
    });
	
	$('.write_msg').keyup(function(e) {
		if(e.keyCode === 13) {
			send();
		}
	});
	
	var div = $(".msg_history");
	div.scrollTop(div.prop('scrollHeight'));
JS;

$this->registerJs($JS, View::POS_END);

?>