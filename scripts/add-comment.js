$(document).ready(function () {

    $('#comment-btn-submit').click(function () {


        var answer, comment, position, positionid;

        answer = $('#modalanswer').val();
        comment = $('#comment').val();
        position = $('#position').val();
        positionid = $('#positionid').val();

        if (!positionid || positionid.length == '') {
            $("#login").modal('show');
            return false;
        } else if (!comment || comment.length === 0) {
            swal({
                title: "Error!",
                text: "Please enter comment...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            $.ajax({
                url: "post-and-get/ajax/comment.php",
                cache: false,
                dataType: "json",
                type: "POST",
                data: {
                    answer: answer,
                    comment: comment,
                    position: position,
                    positionid: positionid,
                    option: 'ADDCOMMENT'
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
                        $('#modalanswer').val('');
                        $('#comment').val('');
                        $("#myModal").modal('hide');
                        swal({
                            title: "Success!",
                            text: "Your comment was posted successfully...",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }


                }
            });
        }


    });
});


