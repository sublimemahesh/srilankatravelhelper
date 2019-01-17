$(document).ready(function (e) {
//    $('#cityid').val('');
    $('#autocomplete').change(function () {
        if (!$('#autocomplete').val() || $('#autocomplete').val() == 0) {
            $('#city').val('');
        }
    });

    $('.search-btn').click(function () {

        $('.select-driver').empty();
        var id = $('#city').val();
        var name = $('#drivername').val();
        var city = $('#cityname').val();


        $.ajax({
            url: "post-and-get/ajax/driver.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                city: id,
                name: name,
                option: 'GETDRIVERDETAILS'
            },
            success: function (drivers) {

                var html = '';
                $.each(drivers.driverswithreviews, function (key, driver) {

                    var html1 = '';
                    var i, j;
                    var divider, sum, stars, img = '';

                    divider = driver.reviews.count;
                    sum = driver.reviews.sum;

                    stars = sum / divider;

                    for (i = 1; i <= stars; i++) {
                        html1 += '<i class="fa fa-star"></i>';
                    }
                    for (j = i; j <= 5; j++) {
                        html1 += '<i class="fa fa-star-o"></i>';
                    }

                    if (driver.driverdetails.profile_picture === '' || !driver.driverdetails.profile_picture) {
                        img = '<img src="upload/driver/driver.png" alt="Profile Picture"/>';
                    } else {
                        if (driver.driverdetails.facebookID && driver.driverdetails.profile_picture.substr(0, 5) === "https") {
                            img = '<img src="' + driver.driverdetails.profile_picture + '"  alt="Profile Picture"/>';
                        } else {
                            img = '<img src="upload/driver/' + driver.driverdetails.profile_picture + '"  alt="Profile Picture"/>';
                        }
                    }

                    html += '<a href="#">';
                    html += '<div class="driver-item driver-item-' + driver.driverdetails.id + ' col-md-6 col-xs-12" onClick="selectItem(' + driver.driverdetails.id + ')">';
                    html += '<div class="col-md-4 col-xs-12">';
                    html += img;
                    html += '</div>';
                    html += '<div class="col-md-8 col-xs-12">';
                    html += '<div class="drivername">';
                    html += '<a href="drivers-view-page.php?id=' + driver.driverdetails.id + '" target="new" >' + driver.driverdetails.name + '</a>';
                    html += '</div>';
                    html += '<div class="star-rate">';
                    html += html1;
                    html += '<span class="reviews"> (' + sum + ' Reviews)</span>';
                    html += '</div>';
                    html += '<div class="drivercity">';
                    html += 'City: ' + driver.driverdetails.cityname + '';
                    html += '</div>';
                    html += '<div class="drivercity">';
                    html += 'Driving Licence No: ' + driver.driverdetails.driving_licence_number + '';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</a>';

                });
                $.each(drivers.driverswithoutreviews, function (key, driver) {

                    var html1 = '';
                    var j,img = '';
                    for (j = 1; j <= 5; j++) {
                        html1 += '<i class="fa fa-star-o"></i>';
                    }
                    if (driver.profile_picture === '' || !driver.profile_picture) {
                        img = '<img src="upload/driver/driver.png" alt="Profile Picture"/>';
                    } else {
                        if (driver.facebookID && driver.profile_picture.substr(0, 5) === "https") {
                            img = '<img src="' + driver.profile_picture + '"  alt="Profile Picture"/>';
                        } else {
                            img = '<img src="upload/driver/' + driver.profile_picture + '"  alt="Profile Picture"/>';
                        }
                    }

                    html += '<a href="#">';
                    html += '<div class="driver-item driver-item-' + driver.id + ' col-md-6 col-xs-12" onClick="selectItem(' + driver.id + ')">';
                    html += '<div class="col-md-4 col-xs-12">';
                    html += img;
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
                    html += 'City: ' + driver.cityname + '';
                    html += '</div>';
                    html += '<div class="drivercity">';
                    html += 'Driving Licence No: ' + driver.driving_licence_number + '';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</a>';

                });


                $('.select-driver').append(html);

            }
        });
    });
});
$('#drivername').on('keydown', function (e) {
    if (e.which == 13) {

        $('.search-btn').click();
    }
});
$('#autocomplete').on('keydown', function (e) {
    if (e.which == 13) {
        $('.search-btn').click();
    }
});


