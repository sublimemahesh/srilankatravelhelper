$(document).ready(function () {


    $('#btn-submit').click(function () {
        var question, answer, position, positionid;

        question = $('#question').val();
        answer = tinyMCE.activeEditor.getContent();
        position = $('#position').val();
        positionid = $('#positionid').val();

        if (!positionid || positionid.length == '') {
            $("#login").modal('show');
            return false;
        } else if (!answer || answer.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter answer...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            $.ajax({
                url: "post-and-get/ajax/answer.php",
                cache: false,
                dataType: "json",
                type: "POST",
                data: {
                    question: question,
                    answer: answer,
                    position: position,
                    positionid: positionid,
                    option: 'ADDANSWER'
                },
                success: function (result) {
                    if (result === 'FALSE') {
                        swal({
                            title: "Error!",
                            text: "Please try again...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        swal({
                            title: "Success!",
                            text: "Your answer was posted successfully...",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        tinyMCE.activeEditor.setContent('');
                    }


                }
            });
        }


    });
});


