$(document).ready(function () {


    $('.driver').click(function () {
        var name = $(this).text();
        var id = $(this).attr('driverid');
        $('#myInput').val(name);
        $('#driverid').val(id);
        $('#myUL').addClass('hidden');
    });
    $('.searchbutton').click(function () {
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
                                
                                stars = sum / divider;
                                
                                for(i = 1; i <= stars; i++) {
                                    html1 += '<i class="fa fa-star"></i>';
                                }
                                for(j = i; j <= 5; j++) {
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


                                        html += '<div class="listing-item">';
                                        html += '<img src="../upload/drivers/driver-photos/thumb/' + photo + '" alt="">';
                                        html += '</div>';
                                        html += '<div class="img-pad">';
                                        html += '<img src="../upload/drivers/' + result.profile_picture + '" class="img-circle driver-list">';
                                        html += '</div>';
                                        html += '<div class="driver-name text-left">';
                                        html += result.name;
                                        html += '</div>';
                                        html += '<div class="row">';
                                        html += '<div class="star-rating-fa text-right col-md-5">';
                                        html += html1;
                                        html += '<div class="rating-counter">('+ total.sum +' reviews)</div><br>';
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







});
