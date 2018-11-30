$(document).ready(function () {
    $('.header-icon1').removeClass('btn-hover');
    $('.header-icon2').removeClass('btn-hover');
    $('.button-left').mouseover(function () {
        $('.header-icon1').addClass('btn-hover');
    });
    $('.button-left').mouseout(function () {
        $('.header-icon1').removeClass('btn-hover');
    });
    $('.button-right').mouseover(function () {
        $('.header-icon2').addClass('btn-hover');
    });
    $('.button-right').mouseout(function () {
        $('.header-icon2').removeClass('btn-hover');
    });
})
$(window).load(function () {
    var width = $(window).width();

    if (width > 576) {
        var contentheight = $(window).height();
        var navigationheight = $(window).height();

        $('.content').css('height', contentheight);
        $('.navigation').css('height', navigationheight);
        $('.header-con').addClass('container');
    } else {
        var contentheight = $(window).height();
        $('.content').css('height', contentheight);
        $('.header-con').removeClass('container');
    }
});