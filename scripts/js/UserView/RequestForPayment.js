$(document).ready(function() {
    //Fetching Summary Data
    var dataTable = $('#requestForPayment').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/UserView/requestForPayment.php",
            method: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true,
        "pagingType": "full_numbers"
    });

    //Clicking Budget Tab
    $('.requestForPaymentTab').click(function () {
        dataTable.ajax.reload();
    });
});