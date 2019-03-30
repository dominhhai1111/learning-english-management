$(document).ready( function () {
    $('#questions-table').DataTable();

    $('.btn-add-question').on('click', function() {
        getQuestionById();
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

function addQuestion(question) {
    var html = '<tr class="question_' + question['id'] + '">'
            + '<input type="hidden" name="questions[]" value="' + question['id'] + '">'
            + '<td>' + question['id'] + '</td>'
            + '<td>'+ question['description'].toString().substr(0, 20) + '</td>'
            + '<td>'+ question['topic_name'] + '</td>'
            + '<td>'+ question['level'] + '</td>'
            + '<td><p class="btn btn-danger" onclick="removeQuestion(' + question['id'] + ')">Delete</p></td>'
            + '</tr>';

    $('.question-table-body').append(html);
}

function removeQuestion(questionId) {
    $('.question-table-body').find('.question_' + questionId).remove();
}