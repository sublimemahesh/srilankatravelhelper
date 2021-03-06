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
                option: 'GETNEARBYDESTINATIONS'
            },
            success: function (locations) {
                var html = '';
                var html1 = '';
                var name = '';


                if (locations === 'FALSE') {
                    html = 'No any nearby destinations in the database';
                    $('.nearbydestinations-carousel').empty();
                    $('.nearbydestinations-carousel').append(html);
                } else if (locations) {
                    $.each(locations, function (key, location) {
                        var html1 = '';
alert(location);
                        var str = location.shortdescription;
                        var strsub = str.substr(0, 100);
                        var locid = location.id;
                        $.ajax({
                            url: "post-and-get/ajax/search-destination.php",
                            cache: false,
                            dataType: "json",
                            type: "POST",
                            data: {
                                relatedlocation: cityid,
                                location: locid,
                                option: 'GETLOCATIONDETAILS'
                            },
                            success: function (result) {


                                if (result != false) {
                                    html1 += '<div class="location-details">';
                                    html1 += '<span title="Bus"><i class="fa fa-bus" title="Bus"></i>' + result.bus_hour + 'h (' + result.bus_distance + 'km)</span><br />';
                                    html1 += '<span title="Train"><i class="fa fa-train" title="Train"></i>' + result.train_hour + 'h (' + result.train_distance + 'km)</span><br />';
                                    html1 += '<span title="Taxi"><i class="fa fa-car" title="Taxi"></i>' + result.taxi_hour + 'h (' + result.taxi_distance + 'km)</span><br />';
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
                                html += '<img src="upload/location/' + location.imagename + '" alt="">';
                                html += '</div>';
                                html += '<div class="package-details">';
                                html += '<div class="package-places">';
                                html += '<a href="destinations-by-city.php?city="' + location.id + '">';
                                html += '<h4>' + location.name + '</h4>';
                                html += '</a>';

                                html += html1;
                                html += '<div class="details">';
                                html += '<p>' + strsub + '</p>';
                                html += '</div>';
                                html += '</div>';
                                html += '<div class="package-ratings-review cities-view-btn">';
                                html += '<a href="destinations-by-city.php?city=' + location.id + '" class="btn btn-success"> <span>View</span></a>';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';

                            }
                        });


//                        $.ajax({
//                            url: "post-and-get/ajax/review.php",
//                            cache: false,
//                            dataType: "json",
//                            type: "POST",
//                            data: {
//                                id: destination.id,
//                                option: 'GETTOTALREVIEWSOFDESTINATION'
//                            },
//                            success: function (reviews) {
//
//                                var i, j, sum, divider, stars = '';
//                                var html1 = '';
//                                if (reviews == 0) {
//                                    for (j = 1; j <= 5; j++) {
//                                        html1 += '<i class="fa fa-star-o"></i>';
//                                    }
//                                    sum = 0;
//
//                                } else {
//                                    divider = reviews.count;
//                                    sum = reviews.sum;
//
//                                    stars = sum / divider;
//
//                                    for (i = 1; i <= stars; i++) {
//                                        html1 += '<i class="fa fa-star"></i>';
//                                    }
//                                    for (j = i; j <= 5; j++) {
//                                        html1 += '<i class="fa fa-star-o"></i>';
//                                    }
//                                }
//                                var destname = destination.name;
//                                if (destname.length > 18) {
//                                    name = destname.substring(0, 12) + '...';
//                                } else {
//                                    name = destname;
//                                }
//
//
//                                html += '<div class="col-md-4 col-sm-6 col-xs-12 search-destination-item">';
//                                html += '<div class="col-md-12 col-sm-12 col-xs-12 search-destination-inner">';
//                                html += '<div class="listing-item col-md-5 col-sm-5 col-xs-5">';
//                                html += '<img src="upload/destination/' + destination.image_name + '" alt=""/>';
//                                html += '</div>';
//                                html += '<div class="search-item-details col-md-7 col-sm-7 col-xs-7">';
//                                html += '<div class="driver-name text-left" title="' + destination.name + '"> ';
//                                html += name;
//                                html += '</div>';
//                                html += '<div class="star-rating-fa">';
//                                html += html1;
//                                html += '<div class="rating-counter">(' + sum + ' reviews)</div><br>';
//                                html += '</div>';
//                                html += '<div style="margin-top: 0px;padding-bottom: 7px;">';
//                                html += '<p class="text-center " id="">';
//                                html += destination.short_description.substring(0, 55) + '...';
//                                html += '</p>';
//                                html += '</div>';
//                                html += '<div class="button-section">';
//                                html += '<a href="destination-type-one-item-view-page.php?id=' + destination.id + '" target="_blank"><button class="btn btn-view"><i class="glyphicon glyphicon-link" ></i></button></a>';
//                                html += '<button class="btn btn-cart add-to-cart" id="add-to-cart-' + destination.id + '" destination-id="' + destination.id + '" back="cart" title="Add to Cart"><i class="glyphicon glyphicon-shopping-cart" ></i></button>';
//                                html += '</div>';
//                                html += '</div>';
//                                html += '</div>';
//                                html += '</div>';
////console.log(html);
//                                $('.nearbydestinations-carousel').empty();
//                                $('.nearbydestinations-carousel').append(html);
//                            }
//                        });
                    });
                    
                    $('.nearbydestinations-carousel').empty();
                    $('.nearbydestinations-carousel').append(html);

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
                    option: 'GETNEARBYDESTINATIONS'
                },
                success: function (destinations) {

                    var html = '';
                    var name = '';

                    if (destinations === 'FALSE') {
                        html = 'No any nearby destinations in the database';
                        $('.nearbydestinations-carousel').empty();
                        $('.nearbydestinations-carousel').append(html);
                    } else if (destinations) {
                        $.each(destinations, function (key, destination) {

                            $.ajax({
                                url: "post-and-get/ajax/review.php",
                                cache: false,
                                dataType: "json",
                                type: "POST",
                                data: {
                                    id: destination.id,
                                    option: 'GETTOTALREVIEWSOFDESTINATION'
                                },
                                success: function (reviews) {
                                    var i, j, sum, divider, stars = '';
                                    var html1 = '';
                                    if (reviews == 0) {
                                        for (j = 1; j <= 5; j++) {
                                            html1 += '<i class="fa fa-star-o"></i>';
                                        }
                                        sum = 0;
                                    } else {
                                        divider = reviews.count;
                                        sum = reviews.sum;

                                        stars = sum / divider;

                                        for (i = 1; i <= stars; i++) {
                                            html1 += '<i class="fa fa-star"></i>';
                                        }
                                        for (j = i; j <= 5; j++) {
                                            html1 += '<i class="fa fa-star-o"></i>';
                                        }
                                    }
                                    var destname = destination.name;
                                    if (destname.length > 18) {
                                        name = destname.substring(0, 16) + '...';
                                    } else {
                                        name = destname;
                                    }

                                    html += '<div class="col-md-4 col-sm-6 col-xs-12 search-destination-item">';
                                    html += '<div class="col-md-12 col-sm-12 col-xs-12 search-destination-inner">';
                                    html += '<div class="listing-item col-md-5 col-sm-5 col-xs-5">';
                                    html += '<img src="upload/destination/' + destination.image_name + '" alt=""/>';
                                    html += '</div>';
                                    html += '<div class="search-item-details col-md-7 col-sm-7 col-xs-7">';
                                    html += '<div class="driver-name text-left" title="' + destination.name + '"> ';
                                    html += name;
                                    html += '</div>';
                                    html += '<div class="star-rating-fa">';
                                    html += html1;
                                    html += '<div class="rating-counter">(' + sum + ' reviews)</div><br>';
                                    html += '</div>';
                                    html += '<div style="margin-top: 0px;padding-bottom: 7px;">';
                                    html += '<p class="text-center " id="">';
                                    html += destination.short_description.substring(0, 55) + '...';
                                    html += '</p>';
                                    html += '</div>';
                                    html += '<div class="button-section">';
                                    html += '<a href="destination-type-one-item-view-page.php?id=' + destination.id + '" target="_blank"><button class="btn btn-view"><i class="glyphicon glyphicon-link" ></i></button></a>';
                                    html += '<button class="btn btn-cart add-to-cart" id="add-to-cart-' + destination.id + '" destination-id="' + destination.id + '" back="cart" title="Add to Cart"><i class="glyphicon glyphicon-shopping-cart" ></i></button>';
                                    html += '</div>';
                                    html += '</div>';
                                    html += '</div>';
                                    html += '</div>';

                                    $('.nearbydestinations-carousel').empty();
                                    $('.nearbydestinations-carousel').append(html);
                                }
                            });
                        });
                    }
                }
            });
        }
    });
});