$(document).ready(function () {
    $('#btn-submit').click(function () {
        alert(111);
        var subject, question, position, positionid;

        subject = $('#subject').val();
        question = tinyMCE.activeEditor.getContent();
        position = $('#position').val();
        positionid = $('#positionid').val();
        
        if(!positionid || positionid.length == '') {
            $("#login").modal('show');
            return false;
        }

        $.ajax({
            url: "post-and-get/ajax/questions.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                subject: subject,
                question: question,
                position: position,
                positionid: positionid,
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
//                    $('#question').text('');
                    tinyMCE.activeEditor.setContent('');
                }


            }
        });
    });
});


