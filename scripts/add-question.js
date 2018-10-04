$(document).ready(function () {
    $('#btn-submit').click(function () {
        var subject, question, visitor;

        subject = $('#subject').val();
        question = $('#question').val();
        visitor = $('#visitor').val();
        
        if(!visitor || visitor.length == '') {
            $("#login").modal('show');
            return false;
        }

        $.ajax({
            url: "post-and-get/ajax/questions.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                visitor: visitor,
                subject: subject,
                question: question,
                option: 'ADDQUESTION'
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
                        text: "Your question was posted successfully...",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $('#subject').val('');
                    $('#question').val('');
                    
                }


            }
        });
    });
});


