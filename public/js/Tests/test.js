$(function () {
    selectPage();

    $('.select-page').on('change', function() {
       selectPage();
    });

    $('.btn-back').on('click', function() {
        backPage();
    });

    $('.btn-next').on('click', function() {
        nextPage();
    });

    $('.btn-submit').on('click', function() {
       getResult();
    });
});

function selectPage() {
    var selectPage = $('.select-page').val();
    $('.page').css('display', 'none');
    $('.page_' + selectPage).css('display', 'block');

    $('.btn-back').css('display', 'inline-block');
    $('.btn-next').css('display', 'inline-block');
    if (selectPage == $('.select-page option:first').val()) $('.btn-back').css('display', 'none');
    if (selectPage == $('.select-page option:last').val()) $('.btn-next').css('display', 'none');
}

function backPage() {
    $('.select-page').val(parseInt($('.select-page').val()) - 1);
    selectPage();
}

function nextPage() {
    $('.select-page').val(parseInt($('.select-page').val()) + 1);
    selectPage();
}

function getResult() {
    var correctNumber = 0;
    var number = 0;
    $.each($('.question'), function(index, value) {
        number++;
        var question = $(value);
        var correctAnswer = question.attr('correct-answer');
        var selectAnswer = question.find('.choice:checked').val();

        if (correctAnswer == selectAnswer) {
            correctNumber++;
        }
    });

    $('.result').find('.score').text(correctNumber + '/' + number);
    $('.test-screen').css('display', 'none');
    $('.result-screen').css('display', 'block');
}