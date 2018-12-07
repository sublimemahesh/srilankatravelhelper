$(document).ready(function () {
    $('#selected-driver').val('');

    /*Click button*/
    $('.next-btn').click(function () {
        var driver = $('#selected-driver').val();
        if (!driver) {
            swal({
                title: "Error!",
                text: "Please Select a Driver...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            $('#tab-select-driver').addClass('hidden');
            $('#tab-tour').removeClass('hidden');

            $('.driver-color').addClass('hidden');
            $('.driver-black').removeClass('hidden');
            $('.book-color').removeClass('hidden');
            $('.book-black').addClass('hidden');
        }
    });
    $('.prev-btn').click(function () {
        $('#tab-select-driver').removeClass('hidden');
        $('#tab-tour').addClass('hidden');

        $('.driver-color').removeClass('hidden');
        $('.driver-black').addClass('hidden');
        $('.book-color').addClass('hidden');
        $('.book-black').removeClass('hidden');
    });

    /*Click icon*/
    $('.book-black').click(function () {
        var driver = $('#selected-driver').val();
        if (!driver) {
            swal({
                title: "Error!",
                text: "Please Select a Driver...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            $('#tab-select-driver').addClass('hidden');
            $('#tab-tour').removeClass('hidden');

            $('.driver-color').addClass('hidden');
            $('.driver-black').removeClass('hidden');
            $('.book-color').removeClass('hidden');
            $('.book-black').addClass('hidden');
        }
    });
    $('.driver-black').click(function () {
        $('#tab-select-driver').removeClass('hidden');
        $('#tab-tour').addClass('hidden');

        $('.driver-color').removeClass('hidden');
        $('.driver-black').addClass('hidden');
        $('.book-color').addClass('hidden');
        $('.book-black').removeClass('hidden');
    });

    $('.btn-submit').click(function () {

        if (!$('#noofadults').val() || $('#noofadults').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter no of adults...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#noofchildren').val() || $('#noofchildren').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter no of children...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#startdate').val() || $('#startdate').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter start date...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#enddate').val() || $('#enddate').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter end date...",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            var visitor = $('#visitor').val();
            var tour = $('#tour').val();
            var driver = $('#selected-driver').val();
            var noofadults = $('#noofadults').val();
            var noofchildren = $('#noofchildren').val();
            var startdate = $('#startdate').val();
            var enddate = $('#enddate').val();
            var message = $('#booking-msg').val();
            var tailormadetour = $('#tailormadetour').val();
            var places = $('#places').val();
            var price = $('#price').val();

            if (tailormadetour == 'tourpackge') {
                $.ajax({
                    url: "post-and-get/ajax/booking.php",
                    cache: false,
                    dataType: "json",
                    type: "POST",
                    data: {
                        visitor: visitor,
                        tour: tour,
                        driver: driver,
                        noofadults: noofadults,
                        noofchildren: noofchildren,
                        startdate: startdate,
                        enddate: enddate,
                        message: message,
                        price: price,
                        option: 'ADDDETAILS'
                    },
                    success: function (result) {
                        if (result === 'FALSE') {
                            swal({
                                title: "Error!",
                                text: "Please try again...",
                                type: 'error',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            swal({
                                title: "Success!",
                                text: "Your booking was saved successfully...",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }

                    }
                });
            } else if (tailormadetour == 'tailormade') {
                $.ajax({
                    url: "post-and-get/ajax/tailormade_tours.php",
                    cache: false,
                    dataType: "json",
                    type: "POST",
                    data: {
                        visitor: visitor,
                        places: places,
                        driver: driver,
                        noofadults: noofadults,
                        noofchildren: noofchildren,
                        startdate: startdate,
                        enddate: enddate,
                        message: message,
                        option: 'ADDDETAILS'
                    },
                    success: function (result) {
                        if (result === 'FALSE') {
                            swal({
                                title: "Error!",
                                text: "Please try again...",
                                type: 'error',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            swal({
                                title: "Success!",
                                text: "Your booking was saved successfully...",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }

                    }
                });
            }
        }
    });
});


