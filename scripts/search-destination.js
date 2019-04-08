$(document).ready(function (event) {
    $('#location-search-btn').click(function () {
        var cityid = $('#city').val();
        var type= $('#type').val();
        var keyword = $('#keyword').val();
         $('.default-destination').addClass('hidden');
//         $('#search-content').removeClass('hidden');
       
        
        if (!cityid || cityid.length === 0) {
            swal({
                position: 'bottom-end',
                title: "Error!",
                text: "Please select a city...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            $.ajax({
                url: "post-and-get/ajax/search-destination.php",
                cache: false,
                dataType: "json",
                type: "POST",
                data: {
                    city: cityid,
                    keyword:keyword,
                    type:type,
                    option: 'SEARCH'
                },
                success: function (destinations) {
                    if (destinations === 'FALSE') {
                        swal({
                            position: 'bottom-end',
                            title: "Error!",
                            text: "Please try again...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {

                        var html = '';
                        var name = '';

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
//                                   convert cha to int  
                                    var spend_time = destination.spend_time;
                                    if (spend_time = null) {
                                        spend_time = 0;

                                    } else {
                                        spend_time = destination.spend_time;
                                    }

                                    html += '<div class="col-md-6 col-sm-6 col-xs-12 search-destination-item">';
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
                                    html += '<button class="btn btn-cart add-to-cart" id="add-to-cart-' + destination.id + '" destination-id="' + destination.id + '" location="' + destination.location + '" spend_time="' + spend_time + '"   back="cart" title="Add to Cart"><i class="glyphicon glyphicon-shopping-cart" ></i></button>';
                                    html += '</div>';
                                    html += '</div>';
                                    html += '</div>';
                                    html += '</div>';

                                    $('#search-content').empty();
                                    $('#search-content').append(html);

                                }
                            });
                        });
                    }
                }
            });


        }
    });

    $('#autocomplete').keyup(function (e) {
        if (e.which == 13) {
            var cityid = $('#city').val();

            if (!cityid || cityid.length === 0) {
                swal({
                    title: "Error!",
                    text: "Please select a city...",
                    type: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
                return false;
            } else {
                $.ajax({
                    url: "post-and-get/ajax/search-destination.php",
                    cache: false,
                    dataType: "json",
                    type: "POST",
                    data: {
                        city: cityid,
                        option: 'SEARCH'
                    },
                    success: function (destinations) {
                        if (destinations === 'FALSE') {
                            swal({
                                title: "Error!",
                                text: "Please try again...",
                                type: 'error',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {

                            var html = '';
                            var name = '';

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

                                        $('#search-content').empty();
                                        $('#search-content').append(html);
                                    }
                                });
                            });
                        }
                    }
                });
            }
        }
    });

    $('#search-content').on('click', '.add-to-cart', function () {

//        this.disabled = true;
//      Spend time calculation
        var spend = $(this).attr('spend_time');
        var allspend = $('.spendtime').val();
        if (allspend == "") {
            allspend = 0;
        } else {
            allspend = $('.spendtime').val();
        }

//        alert(spend);
//        alert(allspend);
//        
        var sum = parseInt(spend) / 60 + parseInt(allspend);
//    $('.spendtime').val(sum);
        $('.spendtime').val(sum + ' h ');
//      Create Location array
        var location = $(this).attr('location');
        var alllocations = $('.dest').val();
        if (alllocations == '') {
            var string = "'" + location + "'";
        } else {
            var string = alllocations + ",'" + location + "'";
        }
        $('.dest').val(string);

    });
});


