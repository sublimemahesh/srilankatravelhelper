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
                        position: 'bottom-end',
                        title: "Error!",
                        text: "This destination already exist in the cart...",
                        type: 'error',
                        timer: 1000,
                        showConfirmButton: false
                    });
                } else {
                    swal({
                        position: 'bottom-end',
                        title: "Success!",
                        text: "This destination was added to cart successfully...",
                        type: 'success',
                        timer: 1000,
                        showConfirmButton: false
                    });
                    var html = '';
                    if (result == 1) {
                        html = '&nbsp;01 item';
                    } else if (result == 0) {
                        html = '&nbsp;&nbsp;0 item';
                    } else if (result < 10) {
                        html = '0' + result + ' items';
                    } else if (result >= 10) {
                        html = result + ' items';
                    }

                    $('.cart-item-count').empty();
                    $('.cart-item-count').append(html);

                }
            }
        });
    });

    $('#search-content').on('click', '.add-to-cart', function () {
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
                        position: 'bottom-end',
                        title: "Error!",
                        text: "This destination already exist in the cart...",
                        type: 'error',
                        timer: 1000,
                        showConfirmButton: false
                        
                    });
                } else {
                    swal({
                        position: 'bottom-end',
                        title: "Success!",
                        text: "This destination was added to cart successfully...",
                        type: 'success',
                        timer: 1000,
                        showConfirmButton: false
                    });
                    var html = '';
                    if (result == 1) {
                        html = '&nbsp;&nbsp;01 item';
                    } else if (result == 0) {
                        html = '&nbsp;&nbsp;0 item';
                    } else if (result < 10) {
                        html = '0' + result + ' items';
                    } else if (result >= 10) {
                        html = result + ' items';
                    }

                    $('.cart-item-count').empty();
                    $('.cart-item-count').append(html);

                }
            }
        });
    });

});


