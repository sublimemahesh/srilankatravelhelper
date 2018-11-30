$(document).ready(function () {
    var locid = $('#id').val();
    $.ajax({
        type: 'POST',
        url: 'post-and-get/ajax/near-by-cities.php',
        dataType: "json",
        data: {
            id: locid,
            option: 'GETNEARBYCITIES'
        },
        success: function (nearbycities) {

            $.each(nearbycities, function (key, city) {
                $('#location-' + city).attr("checked", "checked");
            });
        }
    });
});
