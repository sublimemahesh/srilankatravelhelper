$(document).ready(function () {
    $('#signin').click(function () {

        var username, password;

        username = $('#un').val();
        password = $('#pw').val();

        $.ajax({
            url: "post-and-get/ajax/signin.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                username: username,
                password: password,
                option: 'SIGNIN'
            },
            success: function (result) {

                $('#visitor').val(result.id);
                $('#username').val('');
                $('#password').val('');
                $("#login").modal('hide');
                $("#btn-submit").click();


            }
        });
    });
    $('#signin-with-position').click(function () {

        var username, password, position;

        username = $('#un').val();
        password = $('#pw').val();
        position = $('#ps').val();

        $.ajax({
            url: "post-and-get/ajax/signin.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                username: username,
                password: password,
                position: position,
                option: 'SIGNINWITHPOSITION'
            },
            success: function (result) {
                if (result.status === 'success') {
                    $('#positionid').val(result.positionid);
                    $('#position').val(result.position);
                    $('#ps').val('');
                    $('#username').val('');
                    $('#password').val('');
                    $("#login").modal('hide');
                    $("#btn-submit").click();
                } else {
                    swal({
                        title: "Error!",
                        text: "Please try again...",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }



            }
        });
    });
    $('#signin-in-comment').click(function () {

        var username, password, position;

        username = $('#un').val();
        password = $('#pw').val();
        position = $('#ps').val();

        $.ajax({
            url: "post-and-get/ajax/signin.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                username: username,
                password: password,
                position: position,
                option: 'SIGNININCOMMENT'
            },
            success: function (result) {
                if (result.status === 'success') {
                    $('#positionid').val(result.positionid);
                    $('#position').val(result.position);
                    $('#ps').val('');
                    $('#username').val('');
                    $('#password').val('');
                    $("#login").modal('hide');
                    $('#signin-in-comment').addClass('hidden');
                    $('#signin-with-position').removeClass('hidden');
                    $("#comment-btn-submit").click();
                } else {
                    swal({
                        title: "Error!",
                        text: "Please try again...",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }



            }
        });
    });
});


