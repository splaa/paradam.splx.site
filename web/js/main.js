let main = {
    back: function() {
        let referrer = document.referrer;
        if (!referrer.match('paradam')) {
            window.location = '/';
            return;
        }
        window.history.back();
    }
}