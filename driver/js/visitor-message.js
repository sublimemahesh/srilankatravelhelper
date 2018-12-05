$(document).ready(function () {
    
//    var visitor = $('#visitor').val();
//    $.ajax({
//            type: 'POST',
//            data: {
//                visitorid: visitor,
//                option: 'GETDISTINCTMEMBER'
//            },
//            cache: false,
//            dataType: "json",
//            url: 'post-and-get/ajax/visitor-message.php',
//            success: function (result) {
//                if (result) {
//                    swal({
//                        title: "Success!",
//                        text: "Your data was saved successfully.",
//                        type: 'success',
//                        timer: 2000,
//                        showConfirmButton: false
//                    });
//                } else {
//                    swal({
//                        title: "Error!",
//                        text: "Please try again.",
//                        type: 'error',
//                        timer: 2000,
//                        showConfirmButton: false
//                    });
//                }
//            }
//        });
    
    
    $('#visitor-message').click(function () {
        var message = $('#message').val();
        
        if(message.length === 0 || !message) {
            return false;
        } else {
            return true;
        }
    });
});
$(window).on('keydown', function (e) {
        if (e.which == 13) {
            return true;
        }
    });

