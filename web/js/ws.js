const socket  = new WebSocket(WS_HOST);//помните про порт: он должен совпадать с тем, который использовался при запуске серверной части

window.onload = function() {
    socket.onopen = function (e) {
        //socket.send('{"idUser":{$user_id}}'); //часть моего кода. Сюда вставлять любой валидный json.
        //alert(123);
    };

    socket.onmessage = function(e) {
        // e.data - данные
        let data = JSON.parse(e.data);

        if (data.thread_id == systemData.thread_id) {
            if (data.user_id == systemData.user_id) {
                message(data, true);
            } else {
                message(data, false);
            }
        }

        $('#thread_' + data.thread_id).find('p > .text').html(data.message);

        if (data.user_id != systemData.user_id) {
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
};
$(document).ready(function(){
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

    $(document).on('click', '.confirm_message', function() {
        let action = $(this).data('confirm_message');

        if (parseInt(action) === 0) {
            sendingData.cancel = 1;
        }

        $(this).parent().addClass('hide');
        $('.type_msg').removeClass('hide');
    })
});

function message(data, me) {
    let html = '';
    if (me) {
        html += '<div class="outgoing_msg">';
        html += '<div class="sent_msg">';
        if (data.cancel) {
            html += '<span class="service__finish reason_cancel"><b>Причина отказа:</b></span>';
        }
        if (data.message && data.audio) {
            html += '<p>' + data.message + '<audio controls="" src="' + systemData.host + '/uploads/messages/' + data.audio + '"></audio></p>';
        } else if (data.audio) {
            html += '<p><audio controls="" src="' + systemData.host + '/uploads/messages/' + data.audio + '"></audio></p>';
        } else {
            html += '<p>' + data.message + '</p>';
        }
        if (data.error) {
            html += '<span class="balance_error">' + data.error + '</span>';
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
        if (data.cancel) {
            html += '<span class="service__finish reason_cancel"><b>Причина отказа:</b></span>';
        }
        if (data.message && data.audio) {
            html += '<p>' + data.message + '<audio controls="" src="' + systemData.host + '/uploads/messages/' + data.audio + '"></audio></p>';
        } else if (data.audio) {
            html += '<p><audio controls="" src="' + systemData.host + '/uploads/messages/' + data.audio + '"></audio></p>';
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
        sendingData.timing = '';
        sendingData.cancel = 0;
    }
}