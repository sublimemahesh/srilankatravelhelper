
$(document).ready(function () {

    $("#signup").click(function (e) {
        e.preventDefault();
        var datastring = $("#signup-form").serialize();
        $.ajax({
            url: "post-and-get/ajax/check-driver-email.php",
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

////$(document).ready(function () {
//    $("form").submit(function (e) {
//
//
//        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
//        var email = $('#email').val();
//        var status = false;
//
//        if (!$('#name').val() || $('#name').val().length === 0) {
//            swal({
//                title: "Error!",
//                text: "Please enter your name",
//                type: 'error',
//                timer: 1000,
//                showConfirmButton: false
//            });
//            return false;
//        } else if (!$('#email').val() || $('#email').val().length === 0) {
//            swal({
//                title: "Error!",
//                text: "Please enter your email address",
//                type: 'error',
//                timer: 1000,
//                showConfirmButton: false
//            });
//            return false;
//        } else if (!emailReg.test($('#email').val())) {
//            swal({
//                title: "Error!",
//                text: "please enter a valid email",
//                type: 'error',
//                timer: 1000,
//                showConfirmButton: false
//            });
//            return false;
//        } else if (!$('#cnfemail').val() || $('#cnfemail').val().length === 0) {
//            swal({
//                title: "Error!",
//                text: "Please confirm your email address",
//                type: 'error',
//                timer: 1000,
//                showConfirmButton: false
//            });
//            return false;
//        } else if (!emailReg.test($('#cnfemail').val())) {
//            swal({
//                title: "Error!",
//                text: "please enter a valid email",
//                type: 'error',
//                timer: 1000,
//                showConfirmButton: false
//            });
//            return false;
//        } else if ($('#email').val() !== $('#cnfemail').val()) {
//            swal({
//                title: "Error!",
//                text: "Your email and confirm email does not match",
//                type: 'error',
//                timer: 1000,
//                showConfirmButton: false
//            });
//            return false;
//        } else if (!$('#contact_no').val() || $('#contact_no').val().length === 0) {
//            swal({
//                title: "Error!",
//                text: "Please Enter your contact number",
//                type: 'error',
//                timer: 1000,
//                showConfirmButton: false
//            });
//            return false;
//        } else if (!$('#password').val() || $('#password').val().length === 0) {
//            swal({
//                title: "Error!",
//                text: "Please Enter your password",
//                type: 'error',
//                timer: 1000,
//                showConfirmButton: false
//            });
//            return false;
//        } else if (!$('#password').val() || $('#password').val().length === 0) {
//            swal({
//                title: "Error!",
//                text: "Please Enter your password",
//                type: 'error',
//                timer: 1000,
//                showConfirmButton: false
//            });
//            return false;
//        } else {
//
//            $.ajax({
//                url: "post-and-get/ajax/check-member-email.php",
//                type: "POST",
//                data: {
//                    email: email
//                },
//                dataType: "JSON",
//                success: myCallback
//            });
//
//            function myCallback(jsonStr) {
//
//                if (jsonStr.status === true) {
//                    swal({
//                        title: "Error!",
//                        text: "The email address you entered already exists",
//                        type: 'error',
//                        timer: 1000,
//                        showConfirmButton: false
//                    });
//                } else {
//                    status = true;
//                }
//            }
//
//
//        }
//        
//        if (status) {
//            return true;
//        } else {
//            return false;
//        }
//
//    });
//});
// 