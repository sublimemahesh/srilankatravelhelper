$(document).ready(function () {
    $('#add-review').click(function () {
        var destination, visitor, review, id, message;

        id = $('#reviewid').val();
        destination = $('#destinationid').val();
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
                    destination: destination,
                    visitor: visitor,
                    reviews: review,
                    message: message,
                    option: 'ADDDESTINATIONREVIEW'
                },
                success: function (result) {
                    $('#reviewid').val(result.id);

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
                    destination: destination,
                    visitor: visitor,
                    reviews: review,
                    message: message,
                    option: 'UPDATEDESTINATIONREVIEW'
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


