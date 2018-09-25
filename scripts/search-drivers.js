$(document).ready(function (e) {
    $('#cityid').val('');
    $('.searchbutton').click(function () {
        alert(111);
        $('.select-driver').empty();
        var id = $('#cityid').val();
        var city = $('#myInput').val();

        if (!id) {
            swal({
                title: "Error!",
                text: "Please select a location...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            $.ajax({
                url: "post-and-get/ajax/driver.php",
                cache: false,
                dataType: "json",
                type: "POST",
                data: {
                    city: id,
                    option: 'GETDRIVERDETAILS'
                },
                success: function (drivers) {
                    $.each(drivers, function (key, driver) {
                        $.ajax({
                            url: "post-and-get/ajax/review.php",
                            cache: false,
                            dataType: "json",
                            type: "POST",
                            data: {
                                id: driver.id,
                                option: 'GETTOTALREVIEWS'
                            },
                            success: function (total) {
                                var html = '';

                                if (total == 0) {
                                    var j, html1 = '';

                                    for (j = 1; j <= 5; j++) {
                                        html1 += '<i class="fa fa-star-o"></i>';
                                    }

                                    html += '<a href="#">';
                                    html += '<div class="driver-item driver-item-' + driver.id + ' col-md-6 col-xs-12" onClick="selectItem(' + driver.id + ')>';
                                    html += '<div class="col-md-4 col-xs-12">';
                                    html += '<img src="upload/drivers/' + driver.profile_picture + '" alt=""/>';
                                    html += '</div>';
                                    html += '<div class="col-md-8 col-xs-12">';
                                    html += '<div class="drivername">';
                                    html += '<a href="drivers-view-page.php?id=1" target="new" >' + driver.name + '</a>';
                                    html += '</div>';
                                    html += '<div class="star-rate">';
                                    html += html1;
                                    html += '<span class="reviews"> (0 Reviews)</span>';
                                    html += '</div>';
                                    html += '<div class="drivercity">';
                                    html += 'City: ' + city + '';
                                    html += '</div>';
                                    html += '<div class="drivercity">';
                                    html += 'Driving Licence No: ' + driver.driving_licence_number + '';
                                    html += '</div>';
                                    html += '</div>';
                                    html += '</div>';
                                    html += '</a>';


                                } else {

                                    var divider, sum, stars, i, j, html1 = '';

                                    divider = total.count;
                                    sum = total.sum;

                                    stars = sum / divider;

                                    for (i = 1; i <= stars; i++) {
                                        html1 += '<i class="fa fa-star"></i>';
                                    }
                                    for (j = i; j <= 5; j++) {
                                        html1 += '<i class="fa fa-star-o"></i>';
                                    }

                                    html += '<a href="#">';
                                    html += '<div class="driver-item driver-item-' + driver.id + ' col-md-6 col-xs-12" onClick="selectItem(' + driver.id + ')">';
                                    html += '<div class="col-md-4 col-xs-12">';
                                    html += '<img src="upload/drivers/' + driver.profile_picture + '" alt=""/>';
                                    html += '</div>';
                                    html += '<div class="col-md-8 col-xs-12">';
                                    html += '<a href="drivers-view-page.php?id=1" target="new" >';
                                    html += '<div class="drivername">';
                                    html += driver.name;
                                    html += '</div>';
                                    html += '</a>';
                                    html += '<div class="star-rate">';
                                    html += html1;
                                    html += '<span class="reviews"> (' + sum + ' Reviews)</span>';
                                    html += '</div>';
                                    html += '<div class="drivercity">';
                                    html += 'City: ' + city + '';
                                    html += '</div>';
                                    html += '<div class="drivercity">';
                                    html += 'Driving Licence No: ' + driver.driving_licence_number + '';
                                    html += '</div>';
                                    html += '</div>';
                                    html += '</div>';
                                    html += '</a>';
                                }


                                $('.select-driver').append(html);
                            }
                        });
                    });
                }
            });
        }
    });




});


