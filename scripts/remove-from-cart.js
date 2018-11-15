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

                    }
                }
            });
        });
      
    });

});


