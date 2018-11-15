$(document).ready(function () {

    $('.add-to-cart').click(function () {
        var id = $(this).attr('destination-id');
        var back = $(this).attr('back');

        $.ajax({
            url: "post-and-get/ajax/add-to-cart.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                id: id,
                back: back,
                option: 'ADDTOCART'
            },
            success: function (result) {
                if (result === 'FALSE') {
                    swal({
                        title: "Error!",
                        text: "This destination already exist in the cart...",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    swal({
                        title: "Success!",
                        text: "This destination was added to cart successfully...",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }
        });
    });

});


