$(document).ready(function () {

    $('.newest-btn').addClass('active');
    $('.unanswered-btn').removeClass('active');
    $('.topic-all').removeClass('hidden');
    $('.topic-unanswered').addClass('hidden');
    $('#all').removeClass('hidden');
    $('#unanswered').addClass('hidden');

    $('.unanswered-btn').click(function () {
        $('.unanswered-btn').addClass('active');
        $('.newest-btn').removeClass('active');
        $('.topic-unanswered').removeClass('hidden');
        $('.topic-all').addClass('hidden');
        $('#unanswered').removeClass('hidden');
        $('#all').addClass('hidden');

    });
    $('.newest-btn').click(function () {
        $('.newest-btn').addClass('active');
        $('.unanswered-btn').removeClass('active');
        $('.topic-all').removeClass('hidden');
        $('.topic-unanswered').addClass('hidden');
        $('#all').removeClass('hidden');
        $('#unanswered').addClass('hidden');

    });
    
});

