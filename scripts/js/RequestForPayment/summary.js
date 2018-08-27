$(document).ready(function() {
    //Fetching Summary Data
    var dataTable = $('#summary').DataTable({
        // "processing": true,
        // "serverSide": true,
        // "order": [],
        // "ajax": {
        //     url: "../scripts/php/Summary/cashAdvanceFetchData.php",
        //     method: "POST"
        // },
        // "columnDefs": [{
        //     "targets": [0],
        //     "orderable": false
        // }],
        // "stateSave": true,
        // "pagingType": "full_numbers"
    });

    //Clicking Budget Tab
    $('.summaryTab').click(function () {
        dataTable.ajax.reload();
    });
});