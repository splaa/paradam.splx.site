let main = {
    back: function() {
        let referrer = document.referrer;
        if (!referrer.match('paradam')) {
            window.location = '/';
            return;
        }
        window.history.back();

        return false;
    },
    addQuestion: function() {
        $('.js-input-plus').trigger('click');
    }
}

let pageService = document.getElementById("service_block_form");

if (pageService !== null) {
// SERVICE COST
    let slider = document.getElementById("costRange");
    let output = document.getElementById("totalPrice");

    if (output) {
        output.innerHTML = slider.value;
    }

    if (slider) {
        slider.oninput = function () {
            output.innerHTML = this.value + '$';
        }
    }

// DAY COUNTER
    let sliderDay = document.getElementById("dayRange");
    let outputDay = document.getElementById("totalDay");

    if (outputDay) {
        outputDay.innerHTML = sliderDay.value + ' дня';
    }

    if (sliderDay) {
        sliderDay.oninput = function () {
            outputDay.innerHTML = this.value + ' дня';
        }
    }
}

$(document).on('click', '#button_add_question', function () {
    $('.ib_add_button').trigger('click');
})

$('.multiple-input').on('afterInit', function(){
    // calls on after initialization event
    $('.multiple-input-list__item').each(function(k, v){
        $(v).prepend('<p>Question for buyers ' + (parseInt(k) + 1) + '</p>');
    });
}).on('beforeAddRow', function(e, row, currentIndex) {
    // calls on before add row event
}).on('afterAddRow', function(e, row, currentIndex) {
    // calls on after add row event
    //console.log(currentIndex);
    $(row).prepend('<p>Question for buyers ' + (parseInt(currentIndex)+1) + '</p>');
}).on('beforeDeleteRow', function(e, row, currentIndex){
    // row - HTML container of the current row for removal.
    // For TableRenderer it is tr.multiple-input-list__item
    // calls on before remove row event.
    return confirm('Are you sure you want to delete row?')
}).on('afterDeleteRow', function(e, row, currentIndex){
    // calls on after remove row event
    // console.log(row);
}).on('afterDropRow', function(e, item){
    // console.log('calls on after drop row', item);
});

$('.hover_block').on('click', '.backButton', function(){
    $(this).parents('section').toggleClass("slide");
    $('html, body, #app_container').removeAttr('style');
});

// Open slide page
function windowLoaderFunk(html){
    $('html, body, #app_container').css({
        'overflow' : 'hidden',
        '-moz-overscroll-behavior-y' : 'none',
        '-o-overscroll-behavior-y' : 'none',
        '-webkit-overscroll-behavior-y' : 'none',
        'overscroll-behavior-y' : 'none'
    });
    $('#page_service').find('.desc').html(html);
    $('#page_service').toggleClass("slide");
}