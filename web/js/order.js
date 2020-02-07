function showOrder(order) {
    $('#order .modal-body').html(order);
    $('#order').modal();
}

function getOrder() {

    $.ajax({
        url: '/user/order/show',
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка!!!');
            showOrder(res);
        },
        error: function () {
            alert('Error');
        }
    });
    return false;
}


function clearOrder() {
    $.ajax({
        url: '/user/order/clear',
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка!!!');
            showOrder(res);
        },
        error: function () {
            alert('Error');
        }
    });
}

$('#order .modal-body').on('click', '.del-item', function () {
    var id = $(this).data('id');
    $.ajax({
        url: '/user/order/del-item',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка!!!');
            showOrder(res);
        },
        error: function () {
            alert('Error');
        }
    });
});


$('a.make-order').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/user/order/index',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка!!!');
            showOrder(res);
        },
        error: function () {
            alert('Error');
        }
    });
});
$('a.answer-the-questions').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/user/order/answer-questions',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка!!!');
            showOrder(res);
        },
        error: function () {
            alert('Error');
        }
    });
});
$('span.glyphicon-question-sign').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/user/order/answer-questions',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка!!!');
            showOrder(res);
        },
        error: function () {
            alert('Error');
        }
    });
});
