$(document).ready(function () {
    $('#add-review').click(function () {
        var tour, visitor, review, id;

        id = $('#reviewid').val();
        tour = $('#tourid').val();
        visitor = $('#visitorid').val();
        review = $(this).attr('review');

        if (!id) {
            $.ajax({
                url: "post-and-get/ajax/review.php",
                cache: false,
                dataType: "json",
                type: "POST",
                data: {
                    tour: tour,
                    visitor: visitor,
                    reviews: review,
                    option: 'ADDTOURREVIEW'
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
                    tour: tour,
                    visitor: visitor,
                    reviews: review,
                    option: 'UPDATETOURREVIEW'
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


