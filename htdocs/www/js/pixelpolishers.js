$(document).ready(function() {
    $('.top').click(function() {
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });

    $('.change-theme').click(function() {
        $('body').attr('class', $(this).data('theme'));
        return false;
    });
});