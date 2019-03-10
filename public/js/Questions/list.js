$(document).ready( function () {
    $('#questions-table').DataTable();
});

function confirmDeleteTest(id) {
    if(window.confirm('Do you want delete question ?')) {
        window.location.href = '/questions/delete?id=' + id;
    }
}

function addQuestion() {
    var addTopicId = $('#addTopicId').val();
    location.href='/questions/add?topic_id=' + addTopicId;
}