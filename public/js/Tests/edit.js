$(document).ready( function () {
    $('#questions-table').DataTable();

    $('.btn-add-question').on('click', function() {
        getQuestionById();
    })

    $('.btn-random-question').on('click', function() {
        getRandomQuestions();
    })
});

function getQuestionById() {
    var questionId = $('.question_id').val();
    $.ajax({
        type:'GET',
        url:'/tests/get-question?questionId=' +  questionId,
        success:function(data) {
            addQuestion(data);
        }
    });
}

function getRandomQuestions() {
    var easyQuestionNumber = $('.easy_question_number').val();
    var mediumQuestionNumber = $('.medium_question_number').val();
    var hardQuestionNumber = $('.hard_question_number').val();
    $.ajax({
        type:'GET',
        url:'/tests/get-random-questions?easyQuestionNumber=' +  easyQuestionNumber,
        data: {
            'easyQuestionNumber': easyQuestionNumber,
            'mediumQuestionNumber': mediumQuestionNumber,
            'hardQuestionNumber': hardQuestionNumber
        },
        success:function(data) {
            addQuestions(data);
        }
    });
}

function addQuestions(questions) {
    $.each(questions, function (index, question) {
        addQuestion(question);
    });
}

function addQuestion(question) {
    var html = '<tr class="question_' + question['id'] + '">'
            + '<input type="hidden" name="questions[]" value="' + question['id'] + '">'
            + '<td>' + question['id'] + '</td>'
            + '<td>'+ myconf['topic_types'][question['topic_id']] + '</td>'
            + '<td>'+ myconf['difficulty'][question['level']] + '</td>'
            + '<td><p class="btn btn-danger" onclick="removeQuestion(' + question['id'] + ')">Delete</p></td>'
            + '</tr>';

    $('.question-table-body').append(html);
}

function removeQuestion(questionId) {
    $('.question-table-body').find('.question_' + questionId).remove();
}