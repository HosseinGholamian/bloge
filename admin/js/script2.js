$(document).ready(function() {
    var div_box = "Hello";
    $("body").prepend("<div id='load-screen'><div id='loading'></div></div>");
    $('#load-screen').delay(700).fadeOut(600, function() {
        this.remove();
    })

});