socket = new WebSocket('ws://localhost:8080');//помните про порт: он должен совпадать с тем, который использовался при запуске серверной части
socket.onopen = function(e) {
    //socket.send('{"idUser":{$user_id}}'); //часть моего кода. Сюда вставлять любой валидный json.
};