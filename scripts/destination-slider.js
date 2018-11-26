$(document).ready(function () {
    var destid = $('#dest-id').val();

    $.ajax({
        url: "post-and-get/ajax/destination-photos.php",
        cache: false,
        dataType: "json",
        type: "POST",
        data: {
            id: destid,
            option: 'GETDESTINATIONPHOTOS'
        },
        success: function (result) {
            $(function () {

                var arr = [];
                var len = result.length;

                for (var i = 0; i < len; i++) {
                    arr.push();
                }
                $('#gallery1').imagesGrid({
                    images: result
                });

            });

        }
    });


});