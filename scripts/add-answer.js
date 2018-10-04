$(document).ready(function () {
    $('#btn-submit').click(function () {
        var question, answer, position, positionid;

        question = $('#question').val();
        answer = $('#ans').val();
        position = $('#position').val();
        positionid = $('#positionid').val();
        alert(answer);
        if(!positionid || positionid.length == '') {
            $("#login").modal('show');
            return false;
        }

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
                    $('#answer').val('');
                }


            }
        });
    });
});


