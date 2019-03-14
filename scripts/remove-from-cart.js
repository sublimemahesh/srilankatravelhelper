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
                    if (jsonStr >= 0) {

                        swal({
                            title: "Removed!",
                            text: "Destination has been removed by the cart.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#div-' + key).remove();
                        var html = '';
                        var html1 = '';
                        if (jsonStr == 1) {
                            html = '&nbsp;&nbsp;01 item';
                        } else if (jsonStr == 0) {
                            html = '&nbsp;&nbsp;0 item';
                        } else if (jsonStr < 10) {
                            html = '0' + jsonStr + ' items';
                        } else if (jsonStr >= 10) {
                            html = jsonStr + ' items';
                        }

                        if (jsonStr == 0) {
                            html1 = '<li class="list-group-item"><h3>No any selected destinations in your cart</h3></li>';
                            $('.list-group').empty();
                            $('.list-group').append(html1);
                            $('.review-button').addClass('hidden');
                        }

                        $('.cart-item-count').empty();
                        $('.cart-item-count').append(html);

                            

                    }
                 location.reload();
                }
            });
        });

    });

//    $('.remove-from-cart').click(function () {

        //Remove the spend time
//        var spend = $(this).attr('spend-time');
//        var allspend = $('.spendtime').val();
//
//        var red = parseInt(allspend) - parseInt(spend);
//        $('.spendtime').val(red + ' min ')
//        
//  
//       
//       //  Remove Location array
//        var location = $(this).attr('location');
//                 var alllocations = $('.dest').val();
//                   alert(alllocations);
//        if (alllocations == '') {
//            var string = "'" + location + "'";
//        } else {
//            var string = alllocations + ",'" + location + "'";
//        }
//          var lenall = string.length;
//        var lenold=location.length;
//        alert(lenall);
//           alert(lenold);
//       var res = lenall -lenold;
//        alert(res)
//         var res1 = string.substring(0,res-lenold-4);
//           alert(res1);
//     
//        
//        $('.dest').val(res1);
//        
//    });
});


