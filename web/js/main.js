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

    output.innerHTML = slider.value;

    slider.oninput = function () {
        output.innerHTML = this.value + '$';
    }


// DAY COUNTER
    let sliderDay = document.getElementById("dayRange");
    let outputDay = document.getElementById("totalDay");

    outputDay.innerHTML = sliderDay.value;

    sliderDay.oninput = function () {
        outputDay.innerHTML = this.value + ' Days';
    };
}