let main = {
    back: function() {
        if(history.length === 1){
            window.location = window.location.origin
        } else {
            history.back();
        }
    }
}