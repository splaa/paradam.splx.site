<?php
/**
 * @var \app\modules\message\models\UserThread $selected_user_thread
 * @var \yii\web\View $this
 */

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
							<?= $message->text ?>
						</p>
						<span class="time_date"> <?= Yii::$app->formatter->asRelativeTime($message->created_at ) ?>    |    <?= Yii::$app->formatter->asDate($message->created_at ) ?></span>
					</div>
				</div>
			</div>
		<?php else: ?>
			<div class="outgoing_msg">
				<div class="sent_msg">
					<p>
						<?= $message->text ?>
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
		<button class="msg_send_btn" type="button"><i class="glyphicon glyphicon-send"aria-hidden="true"></i></button>
	</div>
</div>



<?php
$user_id = Yii::$app->user->id;
$avatar = Yii::$app->user->identity->getAvatarSmall();
$alt = Yii::$app->user->identity->alt;
$time = date("Y-m-m H:i:s");
$JS = <<<JS
	function message(data, me) {
	    let html = '';
	    if (me) {
			html += '<div class="outgoing_msg">';
				html += '<div class="sent_msg">';
					html += '<p>' + data.message + '</p>';
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
						html += '<p>' + data.message + '</p>';
						html += '<span class="time_date"> ' + data.time + '    |    ' + data.date + '</span>';
					html += '</div>';
				html += '</div>';
			html += '</div>';
		}
	    
	    $('.msg_history').append(html);
	    
	    $('.msg_history').scrollTop($('.msg_history')[0].scrollHeight);
	}
	
	function send() {
        let message = {
            message:$(".write_msg").val(),
            user_id:'{$user_id}',
            thread_id:'{$selected_user_thread->thread_id}',
            avatar: '{$avatar}',
            alt: '{$alt}',
            time: '{$time}',
            date: '{$time}',
        };

        $(".write_msg").val("");
        
        socket.send(JSON.stringify(message));
	}

	socket = new WebSocket('ws://localhost:8080');//помните про порт: он должен совпадать с тем, который использовался при запуске серверной части
	socket.onopen = function(e) {
		//socket.send('{"idUser":{$user_id}}'); //часть моего кода. Сюда вставлять любой валидный json.
	};

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
JS;

$this->registerJs($JS);

?>