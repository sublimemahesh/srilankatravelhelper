$(document).ready(function () {
    $('.review-add-section').addClass('hidden');
    var get_driver = $('#get_driver').val();
    var get_tour = $('#get_tour').val();
    var get_destination = $('#get_destination').val();

    $('.driver').click(function () {
        var name = $(this).text();
        var id = $(this).attr('driverid');
        $('#myInput').val(name);
        $('#driverid').val(id);
        $('#myUL').addClass('hidden');

    });

    $('.tour').click(function () {
        var name = $(this).text();
        var id = $(this).attr('tourid');
        $('#myInput').val(name);
        $('#tourid').val(id);
        $('#myUL').addClass('hidden');
    });
    $('.destination').click(function () {
        var name = $(this).text();
        var id = $(this).attr('destinationid');
        $('#myInput').val(name);
        $('#destinationid').val(id);
        $('#myUL').addClass('hidden');
    });

    $('.searchbutton').click(function () {
        $('#reviewid').val('');
        $('.driver-profile').empty();
        var id = $('#driverid').val();
        var visitor = $('#visitorid').val();

        $.ajax({
            url: "post-and-get/ajax/review.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                driver: id,
                visitor: visitor,
                option: 'CHECK'
            },
            success: function (review) {
                $('.review-add-section').removeClass('hidden');
                if (!review) {
                    $('.visitor-review').text(0);
                    var i, star = '';

                    for (i = 1; i <= 5; i++) {
                        star += '<div class="star" number="' + i + '" onClick="reviews(' + i + ')" ><a><img class="star1" src="images/black.png" alt=""/></a></div>';
                    }
                } else {
                    $('#reviewid').val(review.id);
                    $('.visitor-review').text(review.reviews);
                    $('#message').text(review.message);
                    $('#add-review').attr('review', review.reviews);


                    var i, j, star_number, star = '';
                    star_number = review.reviews;

                    for (i = 1; i <= star_number; i++) {
                        star += '<div class="star" number="' + i + '" onClick="reviews(' + i + ')" ><a><img class="star1" src="images/yellow.png" alt=""/></a></div>';
                    }
                    for (j = i; j <= 5; j++) {
                        star += '<div class="star" number="' + j + '" onClick="reviews(' + j + ')" ><a><img class="star1" src="images/black.png" alt=""/></a></div>';
                    }
                }

                $('.review-black-star').empty();
                $('.review-black-star').append(star);


                $.ajax({
                    url: "post-and-get/ajax/driver.php",
                    cache: false,
                    dataType: "json",
                    type: "POST",
                    data: {
                        id: id,
                        option: 'GETDRIVERDETAILS'
                    },
                    success: function (result) {

                        $('#driver-name').text(result.name);

                        $.ajax({
                            url: "post-and-get/ajax/review.php",
                            cache: false,
                            dataType: "json",
                            type: "POST",
                            data: {
                                id: result.id,
                                option: 'GETTOTALREVIEWS'
                            },
                            success: function (total) {
                                var divider, sum, stars, i, j, html1 = '';

                                divider = total.count;
                                sum = total.sum;

                                if (sum) {
                                    stars = sum / divider;
                                } else {
                                    sum = 0;
                                    stars = 0;
                                }



                                for (i = 1; i <= stars; i++) {
                                    html1 += '<i class="fa fa-star"></i>';
                                }
                                for (j = i; j <= 5; j++) {
                                    html1 += '<i class="fa fa-star-o"></i>';
                                }


                                $.ajax({
                                    url: "post-and-get/ajax/driver.php",
                                    cache: false,
                                    dataType: "json",
                                    type: "POST",
                                    data: {
                                        id: result.id,
                                        option: 'GETDRIVERPHOTOS'
                                    },
                                    success: function (photo) {
                                        var html = '';
                                        var html2 = '';

                                        if (result.profile_picture == '') {
                                            html2 = '<img src="../upload/driver/driver.png" alt="Profile Picture" class="img-circle driver-list"/>';
                                        } else {
                                            if (result.facebookID && result.profile_picture.substring(0, 5) === "https") {
                                                html2 = '<img src="' + result.profile_picture + '"  alt="Profile Picture" class="img-circle driver-list"/>';
                                            } else {
                                                html2 = ' <img src="../upload/driver/' + result.profile_picture + '"  alt="Profile Picture" class="img-circle driver-list"/>';
                                            }
                                        }

                                        html += '<div class="listing-item">';
                                        html += '<img src="../upload/driver/driver-photos/Cov/' + photo + '" alt="">';
                                        html += '</div>';
                                        html += '<div class="img-pad">';
                                        html += html2;
                                        html += '</div>';
                                        html += '<div class="driver-name text-left">';
                                        html += result.name;
                                        html += '</div>';
                                        html += '<div class="row">';
                                        html += '<div class="star-rating-fa text-right col-md-10">';
                                        html += html1;
                                        html += '<div class="rating-counter">(' + sum + ' reviews)</div><br>';
                                        html += '</div>';
                                        html += '<div class="col-md-7"></div>';
                                        html += '</div>';
                                        html += '<div style="margin-top: 0px;padding-bottom: 7px; text-align: center;">';
                                        html += '<p class="text-center " id="">';
                                        html += result.short_description;
                                        html += '</p>';
                                        html += '</div>';

                                        $('.driver-profile').append(html);
                                        $('.review-add-section').removeClass('hidden');

                                    }
                                });
                            }
                        });
                    }
                });
            }
        });
    });

    $('.searchbutton2').click(function () {
        $('.tour-profile').removeClass('hidden');
        $('#reviewid').val('');
        $('.tour-profile').empty();
        var id = $('#tourid').val();
        var visitor = $('#visitorid').val();

        $.ajax({
            url: "post-and-get/ajax/review.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                tour: id,
                visitor: visitor,
                option: 'CHECKTOUR'
            },
            success: function (review) {

                $('.review-add-section').removeClass('hidden');
                if (!review) {
                    $('.visitor-review').text(0);
                    var i, star = '';

                    for (i = 1; i <= 5; i++) {
                        star += '<div class="star" number="' + i + '" onClick="reviews(' + i + ')" ><a><img class="star1" src="images/black.png" alt=""/></a></div>';
                    }
                } else {
                    $('#reviewid').val(review.id);
                    $('.visitor-review').text(review.reviews);
                    $('#message').text(review.message);
                    $('#add-review').attr('review', review.reviews);

                    var i, j, star_number, star = '';
                    star_number = review.reviews;

                    for (i = 1; i <= star_number; i++) {
                        star += '<div class="star" number="' + i + '" onClick="reviews(' + i + ')" ><a><img class="star1" src="images/yellow.png" alt=""/></a></div>';
                    }
                    for (j = i; j <= 5; j++) {
                        star += '<div class="star" number="' + j + '" onClick="reviews(' + j + ')" ><a><img class="star1" src="images/black.png" alt=""/></a></div>';
                    }
                }

                $('.review-black-star').empty();
                $('.review-black-star').append(star);


                $.ajax({
                    url: "post-and-get/ajax/tour.php",
                    cache: false,
                    dataType: "json",
                    type: "POST",
                    data: {
                        id: id,
                        option: 'GETTOURDETAILS'
                    },
                    success: function (result) {

                        $('#tour-name').text(result.name);

                        $.ajax({
                            url: "post-and-get/ajax/review.php",
                            cache: false,
                            dataType: "json",
                            type: "POST",
                            data: {
                                id: result.id,
                                option: 'GETTOTALREVIEWSOFTOUR'
                            },
                            success: function (total) {
                                var html = '';
                                if (total == 0) {
                                    var j, html1 = '';

                                    for (j = 1; j <= 5; j++) {
                                        html1 += '<i class="fa fa-star-o"></i>';
                                    }

                                    html += '<div class="listing-item">';
                                    html += '<img src="../upload/tour-package/thumb/' + result.image_name + '" alt="">';
                                    html += '</div>';
                                    html += '<div class="tour-name text-left">';
                                    html += result.name;
                                    html += '</div>';
                                    html += '<div class="row">';
                                    html += '<div class="star-rating-fa text-left col-md-10">';
                                    html += html1;
                                    html += '<div class="rating-counter">(0 reviews)</div><br>';
                                    html += '</div>';
                                    html += '<div class="col-md-7"></div>';
                                    html += '</div>';
                                    html += '<div style="margin-top: 0px;padding-bottom: 7px;">';
                                    html += '<p class="" id="">';
                                    html += result.short_description;
                                    html += '</p>';
                                    html += '</div>';

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

                                    html += '<div class="listing-item">';
                                    html += '<img src="../upload/tour-package/thumb/' + result.image_name + '" alt="">';
                                    html += '</div>';
                                    html += '<div class="tour-name text-left">';
                                    html += result.name;
                                    html += '</div>';
                                    html += '<div class="row">';
                                    html += '<div class="star-rating-fa text-left col-md-10">';
                                    html += html1;
                                    html += '<div class="rating-counter">(' + total.sum + ' reviews)</div><br>';
                                    html += '</div>';
                                    html += '<div class="col-md-7"></div>';
                                    html += '</div>';
                                    html += '<div style="margin-top: 0px;padding-bottom: 7px;">';
                                    html += '<p class="" id="">';
                                    html += result.short_description;
                                    html += '</p>';
                                    html += '</div>';
                                }

                                $('.tour-profile').append(html);
                                $('.review-add-section').removeClass('hidden');

                            }
                        });
                    }
                });
            }
        });
    });

    $('.searchbutton3').click(function () {
        $('.destination-profile').removeClass('hidden');
        $('#reviewid').val('');
        $('.destination-profile').empty();
        var id = $('#destinationid').val();
        var visitor = $('#visitorid').val();

        $.ajax({
            url: "post-and-get/ajax/review.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                destination: id,
                visitor: visitor,
                option: 'CHECKDESTINATION'
            },
            success: function (review) {

                $('.review-add-section').removeClass('hidden');
                if (!review) {
                    $('.visitor-review').text(0);
                    var i, star = '';

                    for (i = 1; i <= 5; i++) {
                        star += '<div class="star" number="' + i + '" onClick="reviews(' + i + ')" ><a><img class="star1" src="images/black.png" alt=""/></a></div>';
                    }
                } else {
                    $('#reviewid').val(review.id);
                    $('.visitor-review').text(review.reviews);
                    $('#message').text(review.message);
                    $('#add-review').attr('review', review.reviews);

                    var i, j, star_number, star = '';
                    star_number = review.reviews;

                    for (i = 1; i <= star_number; i++) {
                        star += '<div class="star" number="' + i + '" onClick="reviews(' + i + ')" ><a><img class="star1" src="images/yellow.png" alt=""/></a></div>';
                    }
                    for (j = i; j <= 5; j++) {
                        star += '<div class="star" number="' + j + '" onClick="reviews(' + j + ')" ><a><img class="star1" src="images/black.png" alt=""/></a></div>';
                    }
                }

                $('.review-black-star').empty();
                $('.review-black-star').append(star);

                $.ajax({
                    url: "post-and-get/ajax/destination.php",
                    cache: false,
                    dataType: "json",
                    type: "POST",
                    data: {
                        id: id,
                        option: 'GETDESTINATIONDETAILS'
                    },
                    success: function (result) {

                        $('#destination-name').text(result.name);

                        $.ajax({
                            url: "post-and-get/ajax/review.php",
                            cache: false,
                            dataType: "json",
                            type: "POST",
                            data: {
                                id: result.id,
                                option: 'GETTOTALREVIEWSOFDESTINATION'
                            },
                            success: function (total) {

                                var html = '';

                                if (total == 0) {
                                    var j, html1 = '';

                                    for (j = 1; j <= 5; j++) {
                                        html1 += '<i class="fa fa-star-o"></i>';
                                    }

                                    html += '<div class="listing-item">';
                                    html += '<img src="../upload/destination/thumb1/' + result.image_name + '" alt="">';
                                    html += '</div>';
                                    html += '<div class="destination-name text-left">';
                                    html += result.name;
                                    html += '</div>';
                                    html += '<div class="row">';
                                    html += '<div class="star-rating-fa text-left col-md-10">';
                                    html += html1;
                                    html += '<div class="rating-counter">(0 reviews)</div><br>';
                                    html += '</div>';
                                    html += '<div class="col-md-7"></div>';
                                    html += '</div>';
                                    html += '<div style="margin-top: 0px;padding-bottom: 7px;">';
                                    html += '<p class="" id="">';
                                    html += result.short_description;
                                    html += '</p>';
                                    html += '</div>';
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

                                    html += '<div class="listing-item">';
                                    html += '<img src="../upload/destination/thumb1/' + result.image_name + '" alt="">';
                                    html += '</div>';
                                    html += '<div class="destination-name text-left">';
                                    html += result.name;
                                    html += '</div>';
                                    html += '<div class="row">';
                                    html += '<div class="star-rating-fa text-left col-md-5">';
                                    html += html1;
                                    html += '<div class="rating-counter">(' + total.sum + ' reviews)</div><br>';
                                    html += '</div>';
                                    html += '<div class="col-md-7"></div>';
                                    html += '</div>';
                                    html += '<div style="margin-top: 0px;padding-bottom: 7px;">';
                                    html += '<p class="" id="">';
                                    html += result.short_description;
                                    html += '</p>';
                                    html += '</div>';
                                }

                                $('.destination-profile').append(html);
                                $('.review-add-section').removeClass('hidden');
                            }
                        });
                    }
                });
            }
        });
    });

    if (get_driver != '' || get_driver != 0) {

        var visitor = $('#visitorid').val();

        $.ajax({
            url: "post-and-get/ajax/review.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                driver: get_driver,
                visitor: visitor,
                option: 'CHECK'
            },
            success: function (review) {
                $('#review-add-section-driver').removeClass('hidden');
                if (!review) {
                    $('.visitor-review').text(0);
                    var i, star = '';

                    for (i = 1; i <= 5; i++) {
                        star += '<div class="star" number="' + i + '" onClick="reviews(' + i + ')" ><a><img class="star1" src="images/black.png" alt=""/></a></div>';
                    }
                } else {
                    $('#reviewid').val(review.id);
                    $('.visitor-review').text(review.reviews);
                    $('#message').text(review.message);

                    var i, j, star_number, star = '';
                    star_number = review.reviews;

                    for (i = 1; i <= star_number; i++) {
                        star += '<div class="star" number="' + i + '" onClick="reviews(' + i + ')" ><a><img class="star1" src="images/yellow.png" alt=""/></a></div>';
                    }
                    for (j = i; j <= 5; j++) {
                        star += '<div class="star" number="' + j + '" onClick="reviews(' + j + ')" ><a><img class="star1" src="images/black.png" alt=""/></a></div>';
                    }
                }

                $('.review-black-star').empty();
                $('.review-black-star').append(star);
            }
        });
    } else {
        $('.review-add-section').addClass('hidden');
    }

    if (get_tour !== '' || get_tour != 0) {
        var visitor = $('#visitorid').val();

        $.ajax({
            url: "post-and-get/ajax/review.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                tour: get_tour,
                visitor: visitor,
                option: 'CHECKTOUR'
            },
            success: function (review) {
                $('#review-add-section-tour').removeClass('hidden');
                if (!review) {
                    $('.visitor-review').text(0);
                    var i, star = '';

                    for (i = 1; i <= 5; i++) {
                        star += '<div class="star" number="' + i + '" onClick="reviews(' + i + ')" ><a><img class="star1" src="images/black.png" alt=""/></a></div>';
                    }
                } else {
                    $('#reviewid').val(review.id);
                    $('.visitor-review').text(review.reviews);
                    $('#message').text(review.message);

                    var i, j, star_number, star = '';
                    star_number = review.reviews;

                    for (i = 1; i <= star_number; i++) {
                        star += '<div class="star" number="' + i + '" onClick="reviews(' + i + ')" ><a><img class="star1" src="images/yellow.png" alt=""/></a></div>';
                    }
                    for (j = i; j <= 5; j++) {
                        star += '<div class="star" number="' + j + '" onClick="reviews(' + j + ')" ><a><img class="star1" src="images/black.png" alt=""/></a></div>';
                    }
                }

                $('.review-black-star').empty();
                $('.review-black-star').append(star);
            }
        });
    } else {
        alert(get_driver.length);
        $('.review-add-section').addClass('hidden');
    }

    if (get_destination != '' || get_destination != 0) {

        var visitor = $('#visitorid').val();
        $.ajax({
            url: "post-and-get/ajax/review.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                destination: get_destination,
                visitor: visitor,
                option: 'CHECKDESTINATION'
            },
            success: function (review) {
                $('#review-add-section-destination').removeClass('hidden');
                if (!review) {
                    $('.visitor-review').text(0);
                    var i, star = '';

                    for (i = 1; i <= 5; i++) {
                        star += '<div class="star" number="' + i + '" onClick="reviews(' + i + ')" ><a><img class="star1" src="images/black.png" alt=""/></a></div>';
                    }
                } else {
                    $('#reviewid').val(review.id);
                    $('.visitor-review').text(review.reviews);
                    $('#message').text(review.message);

                    var i, j, star_number, star = '';
                    star_number = review.reviews;

                    for (i = 1; i <= star_number; i++) {
                        star += '<div class="star" number="' + i + '" onClick="reviews(' + i + ')" ><a><img class="star1" src="images/yellow.png" alt=""/></a></div>';
                    }
                    for (j = i; j <= 5; j++) {
                        star += '<div class="star" number="' + j + '" onClick="reviews(' + j + ')" ><a><img class="star1" src="images/black.png" alt=""/></a></div>';
                    }
                }
                $('.review-black-star').empty();
                $('.review-black-star').append(star);
            }
        });
    } else {
        alert(get_driver.length);
        $('.review-add-section').addClass('hidden');
    }
});