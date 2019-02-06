$(document).ready(function () {
    $('#location-search-btn').click(function () {
        var cityid = $('#city').val();
        var cityname = $('#cityname').val();
        $('#search-content1').removeClass('hidden');
        $('#city-name').text(cityname);
        

        $.ajax({
            url: "post-and-get/ajax/search-destination.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                city: cityid,
                option: 'GETNEARBYLOCATIONS'
            },
            success: function (locations) {
                console.log(locations);

                var html = '';
                var name = '';


                if (locations === 'FALSE') {
                    html = 'No any nearby destinations in the database';
                    $('.nearbydestinations-carousel').empty();
                    $('.nearbydestinations-carousel').append(html);
                } else if (locations) {
                    $('.nearbydestinations-carousel').empty();
                    $.each(locations, function (key, location) {
                        var html1 = '';
                        

                        var str = location.location.shortdescription;
                        var strsub = str.substr(0, 100);
                        var destname = location.location.name;
                        if (destname.length > 18) {
                            name = destname.substring(0, 12) + '...';
                        } else {
                            name = destname;
                        }

                        if (location.details !== false) {
                            html1 += '<div class="location-details">';
                            html1 += '<span title="Bus"><i class="fa fa-bus" title="Bus"></i>' + location.details.bus_hour + 'h (' + location.details.bus_distance + 'km)</span><br />';
                            html1 += '<span title="Train"><i class="fa fa-train" title="Train"></i>' + location.details.train_hour + 'h (' + location.details.train_distance + 'km)</span><br />';
                            html1 += '<span title="Taxi"><i class="fa fa-car" title="Taxi"></i>' + location.details.taxi_hour + 'h (' + location.details.taxi_distance + 'km)</span><br />';
                            html1 += '</div>';
                        } else {
                            html1 += '<div class="location-details">';
                            html1 += '<span title="Bus"><i class="fa fa-bus" title="Bus"></i> - </span><br />';
                            html1 += '<span title="Train"><i class="fa fa-train" title="Train"></i> - </span><br />';
                            html1 += '<span title="Taxi"><i class="fa fa-car" title="Taxi"></i> - </span><br />';
                            html1 += '</div>';
                        }

                        html += '<div class="col-md-3 col-sm-6 col-xs-12 carousel-item">';
                        html += '<div class="city-body">';
                        html += '<div class="package-location">';
                        html += '<img src="upload/location/' + location.location.imagename + '" alt="">';
                        html += '</div>';
                        html += '<div class="package-details">';
                        html += '<div class="package-places">';
                        html += '<a href="destinations-by-city.php?city=' + location.location.id + '">';
                        html += '<h4>' + name + '</h4>';
                        html += '</a>';
                        html += html1;
                        html += '<div class="details">';
                        html += '<p>' + strsub + '</p>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="package-ratings-review cities-view-btn">';
                        html += '<a href="destinations-by-city.php?city=' + location.location.id + '" class="btn btn-success"> <span>View</span></a>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';

                    });
                    
                    $('.nearbydestinations-carousel').empty();
                    $('.nearbydestinations-carousel').append(html);
//                    $('.nearbydestinations-carousel').slick('slickRemove');
//                    $('.nearbydestinations-carousel').slick('refresh');
//                    $('.carousel-item').addClass('hidden');
//                    $('.slick-slide').removeClass('hidden');
                }
            }
        });
    });

    $('#autocomplete').keyup(function (e) {
        if (e.which == 13) {
            var cityid = $('#city').val();
            var cityname = $('#cityname').val();
            $('#search-content1').removeClass('hidden');
            $('#city-name').text(cityname);

            $.ajax({
                url: "post-and-get/ajax/search-destination.php",
                cache: false,
                dataType: "json",
                type: "POST",
                data: {
                    city: cityid,
                    option: 'GETNEARBYLOCATIONS'
                },
                success: function (locations) {
                    console.log(locations);
                    var html = '';
                    var name = '';

                    if (locations === 'FALSE') {
                        html = 'No any nearby destinations in the database';
                        $('.nearbydestinations-carousel').empty();
                        $('.nearbydestinations-carousel').append(html);
                    } else if (locations) {
                        $.each(locations, function (key, location) {
                            var html1 = '';

                            var str = location.location.shortdescription;
                            var strsub = str.substr(0, 100);
                            var destname = location.location.name;
                            if (destname.length > 18) {
                                name = destname.substring(0, 12) + '...';
                            } else {
                                name = destname;
                            }

                            if (location.details !== false) {
                                html1 += '<div class="location-details">';
                                html1 += '<span title="Bus"><i class="fa fa-bus" title="Bus"></i>' + location.details.bus_hour + 'h (' + location.details.bus_distance + 'km)</span><br />';
                                html1 += '<span title="Train"><i class="fa fa-train" title="Train"></i>' + location.details.train_hour + 'h (' + location.details.train_distance + 'km)</span><br />';
                                html1 += '<span title="Taxi"><i class="fa fa-car" title="Taxi"></i>' + location.details.taxi_hour + 'h (' + location.details.taxi_distance + 'km)</span><br />';
                                html1 += '</div>';
                            } else {
                                html1 += '<div class="location-details">';
                                html1 += '<span title="Bus"><i class="fa fa-bus" title="Bus"></i> - </span><br />';
                                html1 += '<span title="Train"><i class="fa fa-train" title="Train"></i> - </span><br />';
                                html1 += '<span title="Taxi"><i class="fa fa-car" title="Taxi"></i> - </span><br />';
                                html1 += '</div>';
                            }

                            html += '<div class="col-md-3 col-sm-6 col-xs-12 carousel-item">';
                            html += '<div class="city-body">';
                            html += '<div class="package-location">';
                            html += '<img src="upload/location/' + location.location.imagename + '" alt="">';
                            html += '</div>';
                            html += '<div class="package-details">';
                            html += '<div class="package-places">';
                            html += '<a href="destinations-by-city.php?city=' + location.location.id + '">';
                            html += '<h4>' + name + '</h4>';
                            html += '</a>';
                            html += html1;
                            html += '<div class="details">';
                            html += '<p>' + strsub + '</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="package-ratings-review cities-view-btn">';
                            html += '<a href="destinations-by-city.php?city=' + location.location.id + '" class="btn btn-success"> <span>View</span></a>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';

                        });
                        $('.nearbydestinations-carousel').empty();
                        $('.nearbydestinations-carousel').append(html);
                    }
                }
            });
        }
    });
});