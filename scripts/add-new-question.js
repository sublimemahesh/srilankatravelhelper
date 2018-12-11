$(document).ready(function (e) {
    if (e.keyCode == 13) {
        e.preventDefault();
    }
    $('#subject').keyup(function (e) {
//        var quId = $('#qu-id').val();
        if (e.which != 38) {
            if (e.which != 40) {
                if (e.which != 13) {
                    var keyword = $('#subject').val();
                    $.ajax({
                        type: 'POST',
                        url: 'post-and-get/ajax/add-new-question.php',
                        dataType: "json",
                        data: {keyword: keyword, option: 'GETNAME'},
                        success: function (result) {
                            var html = '';

                            $.each(result, function (key) {
                                if (key === 0) {
//                                    html += '<li id="c' + this.id + '" class="subject">' + this.subject + '</li>';
                                    html += '<a href="view-question.php?id=' + this.id + '" target="_blank"><li id="c' + this.id + '" class="subject selected">' + this.subject + '</li></a>';
                                } else {
                                    html += '<a href="view-question.php?id=' + this.id + '" target="_blank"><li id="c' + this.id + '" class="subject">' + this.subject + '</li></a>';
                                }
                            });
                            $('#subject-list-append').empty();
                            $('#subject-list-append').append(html);
                        }
                    });
                }
            }
        }

    });
    $('#subject-list-append').on('click', '.subject', function () {

        var questionId = this.id;
        var question = $(this).text();
        $('#qu-id').val(questionId.replace("c", ""));
        $('#subject').val(question);
        $('#subject-list-append').empty();

        $('#subject').change(function () {
            $('#qu-id').val("");
        });
    });
    $('#subject-list-append').on('mouseover', '.subject', function () {
        var questionId = this.id;
        var question = $(this).text();
        $('#qu-id').val(questionId.replace("c", ""));
        $('#subject').val(question);
        $('#subject').change(function () {
            $('#qu-id').val("");
        });
    });

    $('#subject').keypress(function (e) {
        var $selected = $('li.selected'), $li = $('li.subject');
        if (e.keyCode == 40) {
            var res = $selected.removeClass('selected').next().addClass('selected');
            if ($selected.next().length == 0) {
                $li.eq(0).addClass('selected');
            }
            if (res) {
//                var questionId = $('li.selected').attr('id');
                var question = $('li.selected').text();
//                $('#qu-id').val(questionId.replace("c", ""));
                $('#subject').val(question);
            }

        } else if (e.keyCode === 38) {
            var res = $selected.removeClass('selected').prev().addClass('selected');
            if ($selected.prev().length == 0) {
                $li.eq(-1).addClass('selected');
            }
            if (res) {
//                var questionId = $('li.selected').attr('id');
                var question = $('li.selected').text();
//                $('#qu-id').val(questionId.replace("c", ""));
                $('#subject').val(question);
            }

        } else if (e.which === 13) {
            e.preventDefault();
            var selected = $('.selected').attr("id");
//            var questionsubject = $('.selected').text();
            var questionId = selected.replace("c", "");
            $('#qu-id').val(questionId);
            $('#subject').attr('attempt', 1);

            var questionsubject = $('li.selected').text();
            $('#subject').val(questionsubject);

            $('#subject-list-append').empty();

            $('#subject').change(function (e) {
                $('#subject').attr('attempt', 0);

            });
        }
    });
    $('#subject').change(function () {
        if ($('#subject').attr('attempt') != 1) {
            $('#qu-id').val("");
        }

    });
});