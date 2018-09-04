
$(document).ready(function () {

    $("#signup").click(function (e) {
        e.preventDefault();
        var datastring = $("#signup-form").serialize();
        $.ajax({
            url: "post-and-get/ajax/check-visitor-email.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: datastring,
            success: function (result) {
                if (result.status === 'error') {
                    $('.error-msg').removeClass('hidden');
                    $('.login-box').addClass('error-login-box');
                    $('#message').text(result.message);
                    return false;
                } else if (result.status === 'error1') {
                    $('.error-msg1').removeClass('hidden');
                    $('.login-box').addClass('error-login-box1');
                    $('#message1').text(result.message);
                    return false;
                } else if (result.status === 'success') {
                    window.location.replace('profile.php?message=22');
                } else if (result.status === 'registered') {
                    window.location.replace('forgot-password.php?message=26');
                }
            }
        });
    });
});

