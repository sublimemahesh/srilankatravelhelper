$(document).ready(function () {

    $('#signup').click(function () {

        var name, email, username, password, cpassword, position;

        name = $('#name').val();
        email = $('#email').val();
        username = $('#un1').val();
        password = $('#pw1').val();
        cpassword = $('#cpassword').val();
        position = $('#pos').val();

        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        if (!name || name.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter name...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!email || email.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter email...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!emailReg.test(email)) {
            swal({
                title: "Error!",
                text: "Please enter valid email...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!username || username.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter username...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!password || password.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter password...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!cpassword || cpassword.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter confirm password...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (password !== cpassword) {
            swal({
                title: "Error!",
                text: "Your password and confirm password does not match",
                type: 'error',
                timer: 1000,
                showConfirmButton: false
            });
            return false;
        } else if (!position || position.length === 0) {
            swal({
                title: "Error!",
                text: "Please select position...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            $.ajax({
                url: "post-and-get/ajax/signup.php",
                cache: false,
                dataType: "json",
                type: "POST",
                data: {
                    email: email,
                    position: position,
                    option: 'CHECKEMAIL'
                },
                success: function (result) {

                    if (result === 'registered') {
                        swal({
                            title: "Error!",
                            text: "The email address you entered is already in use...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        return false;
                    } else {
                        $.ajax({
                            url: "post-and-get/ajax/signup.php",
                            cache: false,
                            dataType: "json",
                            type: "POST",
                            data: {
                                username: username,
                                position: position,
                                option: 'CHECKUSERNAME'
                            },
                            success: function (result) {

                                if (result === 'error') {
                                    swal({
                                        title: "Error!",
                                        text: "The username you entered is already in use...",
                                        type: 'error',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                    return false;
                                } else {
                                    $.ajax({
                                        url: "post-and-get/ajax/signup.php",
                                        cache: false,
                                        dataType: "json",
                                        type: "POST",
                                        data: {
                                            name: name,
                                            email: email,
                                            username: username,
                                            password: password,
                                            position: position,
                                            option: 'SIGNUP'
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
                                }
                            }
                        });
                    }
                }
            });
        }


    });
    
    $('#signup-answer').click(function () {

        var name, email, username, password, cpassword, position;

        name = $('#name').val();
        email = $('#email').val();
        username = $('#un1').val();
        password = $('#pw1').val();
        cpassword = $('#cpassword').val();
        position = $('#pos').val();

        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        if (!name || name.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter name...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!email || email.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter email...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!emailReg.test(email)) {
            swal({
                title: "Error!",
                text: "Please enter valid email...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!username || username.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter username...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!password || password.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter password...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!cpassword || cpassword.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter confirm password...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (password !== cpassword) {
            swal({
                title: "Error!",
                text: "Your password and confirm password does not match",
                type: 'error',
                timer: 1000,
                showConfirmButton: false
            });
            return false;
        } else if (!position || position.length === 0) {
            swal({
                title: "Error!",
                text: "Please select position...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            $.ajax({
                url: "post-and-get/ajax/signup.php",
                cache: false,
                dataType: "json",
                type: "POST",
                data: {
                    email: email,
                    position: position,
                    option: 'CHECKEMAIL'
                },
                success: function (result) {

                    if (result === 'registered') {
                        swal({
                            title: "Error!",
                            text: "The email address you entered is already in use...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        return false;
                    } else {
                        $.ajax({
                            url: "post-and-get/ajax/signup.php",
                            cache: false,
                            dataType: "json",
                            type: "POST",
                            data: {
                                username: username,
                                position: position,
                                option: 'CHECKUSERNAME'
                            },
                            success: function (result) {

                                if (result === 'error') {
                                    swal({
                                        title: "Error!",
                                        text: "The username you entered is already in use...",
                                        type: 'error',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                    return false;
                                } else {
                                    $.ajax({
                                        url: "post-and-get/ajax/signup.php",
                                        cache: false,
                                        dataType: "json",
                                        type: "POST",
                                        data: {
                                            name: name,
                                            email: email,
                                            username: username,
                                            password: password,
                                            position: position,
                                            option: 'SIGNUP'
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
                                }
                            }
                        });
                    }
                }
            });
        }


    });
    
    $('#signup-comment').click(function () {

        var name, email, username, password, cpassword, position;

        name = $('#name').val();
        email = $('#email').val();
        username = $('#un1').val();
        password = $('#pw1').val();
        cpassword = $('#cpassword').val();
        position = $('#pos').val();

        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        if (!name || name.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter name...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!email || email.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter email...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!emailReg.test(email)) {
            swal({
                title: "Error!",
                text: "Please enter valid email...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!username || username.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter username...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!password || password.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter password...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!cpassword || cpassword.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter confirm password...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (password !== cpassword) {
            swal({
                title: "Error!",
                text: "Your password and confirm password does not match",
                type: 'error',
                timer: 1000,
                showConfirmButton: false
            });
            return false;
        } else if (!position || position.length === 0) {
            swal({
                title: "Error!",
                text: "Please select position...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            $.ajax({
                url: "post-and-get/ajax/signup.php",
                cache: false,
                dataType: "json",
                type: "POST",
                data: {
                    email: email,
                    position: position,
                    option: 'CHECKEMAIL'
                },
                success: function (result) {

                    if (result === 'registered') {
                        swal({
                            title: "Error!",
                            text: "The email address you entered is already in use...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        return false;
                    } else {
                        $.ajax({
                            url: "post-and-get/ajax/signup.php",
                            cache: false,
                            dataType: "json",
                            type: "POST",
                            data: {
                                username: username,
                                position: position,
                                option: 'CHECKUSERNAME'
                            },
                            success: function (result) {

                                if (result === 'error') {
                                    swal({
                                        title: "Error!",
                                        text: "The username you entered is already in use...",
                                        type: 'error',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                    return false;
                                } else {
                                    $.ajax({
                                        url: "post-and-get/ajax/signup.php",
                                        cache: false,
                                        dataType: "json",
                                        type: "POST",
                                        data: {
                                            name: name,
                                            email: email,
                                            username: username,
                                            password: password,
                                            position: position,
                                            option: 'SIGNUP'
                                        },
                                        success: function (result) {

                                            if (result.status === 'success') {
                                                $('#positionid').val(result.positionid);
                                                $('#position').val(result.position);
                                                $('#ps').val('');
                                                $('#username').val('');
                                                $('#password').val('');
                                                $("#login").modal('hide');
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
                                }
                            }
                        });
                    }
                }
            });
        }


    });
});