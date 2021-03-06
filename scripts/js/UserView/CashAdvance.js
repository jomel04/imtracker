$(document).ready(function() {
    //Fetching User View Summary Data
    var dataTable = $('#cashAdvance').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/UserView/cashAdvance.php",
            method: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true
    });

    //Clicking Budget Tab
    $('.cashAdvanceTab').click(function () {
        dataTable.ajax.reload();
    });
});