$(document).ready(function() {
    //Fetching Summary Data
    var dataTable = $('#summary').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/Summary/requestForPayment.php",
            method: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true
    });

    //Clicking Budget Tab
    $('.summaryTab').click(function () {
        dataTable.ajax.reload();
    });
});