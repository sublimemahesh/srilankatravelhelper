$(document).ready(function () {
    
    $('#nav-signup').click(function () {
        $('#tab-signin').addClass('hidden');
        $('#tab-signup').removeClass('hidden');
        $('#nav-signin').removeClass('active');
        $('#nav-signup').addClass('active');
        $('#signin').addClass('hidden');
        $('#signup').removeClass('hidden');
    });
    $('#nav-signin').click(function () {
        $('#tab-signin').removeClass('hidden');
        $('#tab-signup').addClass('hidden');
        $('#nav-signin').addClass('active');
        $('#nav-signup').removeClass('active');
        $('#signin').removeClass('hidden');
        $('#signup').addClass('hidden');
    });
    
    
    $('#signin').click(function () {

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
                option: 'SIGNIN'
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


