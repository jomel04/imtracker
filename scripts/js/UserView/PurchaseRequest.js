$(document).ready(function() {
    //Fetching User View Summary Data
    var dataTable = $('#purchaseRequest').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/UserView/purchaseRequest.php",
            method: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true
    });

    //Clicking Budget Tab
    $('.purchaseRequestTab').click(function () {
        dataTable.ajax.reload();
    });
});