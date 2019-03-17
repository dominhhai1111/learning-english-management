var questions = 1;

$(function() {
   $('.btn-add').on('click', function() {
        var question = $('.question-template-area').find('.question-template').clone();
       question.html(question.html().replace(/questionNo/g, questions));
       question.html(question.html().replace(/questionsTmp/g, 'questions'));
       question.css('display', 'block');
       $('.question-area').append(question);
       questions++;
   });

    $("#inputImage").change(function() {
        readURL(this);
    });
});

function readURL(input) {
    var className = input.className + '_show';
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.' + className).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}