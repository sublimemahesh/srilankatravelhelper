$(document).ready(function() {
    $('#sign-in').click(function() {
        $('#signup-form').addClass('hidden');
        $('#signin-form').removeClass('hidden');
        $('.login-box').addClass('login-box1');
        $('.login-box').removeClass('login-box4');
        $('.login-link1').removeClass('hidden');
        $('.login-link').addClass('hidden');
    });
    $('#sign-up').click(function() {
        $('#signin-form').addClass('hidden');
        $('#signup-form').removeClass('hidden');
        $('.login-box').removeClass('login-box1');
        $('.login-link1').addClass('hidden');
        $('.login-link').removeClass('hidden');
    });
    
    
});


