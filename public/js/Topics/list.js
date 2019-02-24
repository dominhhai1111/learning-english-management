$(document).ready( function () {
    $('#topics-table').DataTable();
});

function confirmDeleteTopic(id) {
    if(window.confirm('Do you want delete topic ?')) {
        window.location.href = '/topics/delete?id=' + id;
    }
}