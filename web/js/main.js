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
    let price = document.getElementById("totalPrice");
    let output = document.getElementById("totalPriceOutput");

    if (price) {
        price.innerHTML = getCurrencyValue(slider.value);
    }

    if (output) {
        output.innerHTML = getPercentPrice(slider.value, true);
    }

    if (slider) {
        slider.oninput = function () {
            price.innerHTML = getCurrencyValue(this.value);
            output.innerHTML = getPercentPrice(this.value, true);
        }

        slider.onmouseup = function () {
            $('#costRange').val(getPercentPrice($('#costRange').val(), false));
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

//Tabs
$(document).on("click", ".tabs__item", function () {
    $(".tabs__item").removeClass("tabs__item_active");
    $(this).addClass("tabs__item_active");
    $(".tabs__container").hide();

    let type = $(this).data('type');
    $(this).parents('form').find('input[name="type"]').val(type);
});

//Mask phone
//TODO: babel transpiler to old browser`s
if ($(".inputTelCode1").length > 0) {
    var settingsMask = phoneCodes.find((e) => e.cc === "UA");
    phoneCodes.map((c) => {
        $(".inputTelCode__dropdown").append(
            `<div class="inputTelCode__dropdownItem" data-code="${c.code}" data-cc="${c.cc}" data-mask="${c.mask}">${c.cc} ${c.code}</div>`
        );
    });

    $(".inputTelCode input[type=tel]").inputmask({
        mask: settingsMask.mask,
        autoUnmask: true,
        clearIncomplete: true,
    });

    $(document).on("click", ".inputTelCode__label", function () {
        var $dropDown = $(".inputTelCode__dropdown");
        if (!$dropDown.hasClass("open")) $dropDown.addClass("open");
        else $dropDown.removeClass("open");
    });

    $(document).on("click", function (e) {
        var $dropDown = $(".inputTelCode__dropdown");
        var $dropOpener = $(".inputTelCode__label");
        if (!$dropDown.is(e.target) && !$dropOpener.is(e.target)) {
            $dropDown.removeClass("open");
        }
    });

    $(document).on("click", ".inputTelCode__dropdownItem", function () {
        $(".inputTelCode__label").html($(this).html());
        $(".inputTelCode input[name=code]").val($(this).data("code"));
        $(".inputTelCode input[name=cc]").val($(this).data("cc"));
        $(".inputTelCode input[type=tel]").inputmask({
            mask: $(this).data("mask"),
            autoUnmask: true,
            clearMaskOnLostFocus: false,
        });
    });
}

$('.multiple-input').on('afterInit', function(){
    // calls on after initialization event
    $('.multiple-input-list__item').each(function(k, v){
        $(v).prepend('<label class="inputBlock-top__label">Вопрос ' + (parseInt(k) + 1) + '</label>');
    });
}).on('beforeAddRow', function(e, row, currentIndex) {
    // calls on before add row event
}).on('afterAddRow', function(e, row, currentIndex) {
    // calls on after add row event
    //console.log(currentIndex);
    $(row).prepend('<label class="inputBlock-top__label">Вопрос ' + (parseInt(currentIndex)+1) + '</label>');
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

$(document).on('input', '#desc_servise, #name_servise', function () {
    let max = $(this).attr('data-max');

    if($(this).val().length <= max){
        $(this).parents('.inputBlock').find('.inputBlock-top__current').text($(this).val().length);
    } else{
        $(this).val($(this).val().substr(0, max));
    }
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
function getCurrencyValue(amount) {
    return amount + currency_bits;
}
function getPercentPrice(amount, format) {
    if (format) {
        return getCurrencyValue(Math.round(parseFloat(amount) * (100 - commision_percent_service)) / 100);
    } else {
        return Math.round(parseFloat(amount) * (100 - commision_percent_service)) / 100;
    }
}