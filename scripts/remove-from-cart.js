$(document).ready(function () {

    $('.remove-from-cart').click(function () {
        var id = $(this).attr('destination-id');
        var key = $(this).attr('array-key');


        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this action!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, remove it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/remove-from-cart.php",
                type: "POST",
                data: {key: key, option: 'remove'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr) {

                        swal({
                            title: "Removed!",
                            text: "Destination has been removed by the cart.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#li-' + key).remove();
                        var html = '';
                        if (jsonStr == 1) {
                            html = '&nbsp;&nbsp;01 item';
                        } else if (jsonStr == 0) {
                            html = '&nbsp;&nbsp;0 item';
                        } else if (jsonStr < 10) {
                            html = '0' + jsonStr + ' items';
                        } else if (jsonStr >= 10) {
                            html = jsonStr + ' items';
                        }

                        $('.cart-item-count').empty();
                        $('.cart-item-count').append(html);

                    }
                }
            });
        });

    });

});


