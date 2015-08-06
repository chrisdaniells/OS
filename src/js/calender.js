$(document).ready(function() {
    setInterval(function() {
        var date = new Date();
        $('calender span').html(
            date.getHours() + ":" + (date.getMinutes()<10?'0':'') + date.getMinutes()
        );
    }, 500);
});