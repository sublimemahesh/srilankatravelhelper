$(document).ready(function () {
    $('.confirm-tailor-made-booking').click(function () {
       
        var id = $(this).attr("data-id");
        var bookingid = $(this).attr("data-booking-id");
        
        swal({
            title: "Are you sure?",
            text: "Are you want to Confirm this booking",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Confirm it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/confirm-tour-package-booking.php",
                type: "POST",
                data: {id: id,
                    bookingid: bookingid,
                    option: 'confirm'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Success!",
                            text: "Your booking has been Confirmed.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#row_' + id).remove();

                    }
                }
            });
        });
    });
});