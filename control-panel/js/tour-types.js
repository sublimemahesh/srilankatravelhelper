$(document).ready(function () {
    var tourid = $('#id').val();
    $.ajax({
        type: 'POST',
        url: 'post-and-get/ajax/tour-types.php',
        dataType: "json",
        data: {
            id: tourid,
            option: 'GETTOURTYPES'
        },
        success: function (types) {

            $.each(types, function (key, type) {
                $('#type-' + type).attr("selected", "selected");
            });
        }
    });

});


