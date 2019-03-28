$(document).ready(function () {
    $('#add-review').click(function () {

        var driver, visitor, review, id, message;

        id = $('#reviewid').val();
        driver = $('#driverid').val();
        visitor = $('#visitorid').val();
        review = $(this).attr('review');
        message = $('#message').val();

        if (!id) {
            $.ajax({
                url: "post-and-get/ajax/review.php",
                cache: false,
                dataType: "json",
                type: "POST",
                data: {
                    driver: driver,
                    visitor: visitor,
                    reviews: review,
                    message: message,
                    option: 'ADDREVIEW'
                },
                success: function (result) {

                    swal({
                        title: "Success!",
                        text: "Your review was saved successfully...",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });


                }
            });
        } else {
            $.ajax({
                url: "post-and-get/ajax/review.php",
                cache: false,
                dataType: "json",
                type: "POST",
                data: {
                    id: id,
                    driver: driver,
                    visitor: visitor,
                    reviews: review,
                    message: message,
                    option: 'UPDATEREVIEW'
                },
                success: function (result) {

                    swal({
                        title: "Success!",
                        text: "Your review was update successfully...",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });


                }
            });
        }

    });
});


