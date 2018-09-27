
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
                    if (result.message == 1) {
                        window.location.replace('index.php?message=28');
                    } else if (result.message == 2) {
                        window.location.replace('index.php?message=11');
                    } else if (result.message == 3) {
                        window.location.replace('index.php?message=13');
                    } else if (result.message == 4) {
                        window.location.replace('index.php?message=30');
                    } else if (result.message == 5) {
                        window.location.replace('index.php?message=31');
                    } else if (result.message == 6) {
                        window.location.replace('index.php?message=32');
                    }
                } else if (result.status === 'error1') {
                    $('.error-msg1').removeClass('hidden');
                    if (result.message == 7) {
                        window.location.replace('index.php?message=29');
                    } else if (result.message == 8) {
                        window.location.replace('index.php?message=33');
                    }
                } else if (result.status === 'success') {
                    window.location.replace('profile.php?message=22');
                } else if (result.status === 'registered') {
                    window.location.replace('forgot-password.php?message=26');
                }
            }
        });
    });
});

