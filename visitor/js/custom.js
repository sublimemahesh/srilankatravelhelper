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