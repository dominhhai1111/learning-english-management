$(document).ready( function () {
    $('#tests-table').DataTable();
});

function confirmDeleteTest(id) {
    if(window.confirm('Do you want delete test ?')) {
        window.location.href = '/tests/delete?id=' + id;
    }
}