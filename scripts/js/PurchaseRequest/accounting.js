$(document).ready(function () {
    //Fetching Accounting Data
    var dataTable = $('#accounting').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/Accounting/PurchaseRequest/fetchData.php",
            method: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true,
        "pagingType": "full_numbers"
    });

    //Reload AJAX
    $('.accountingTab').click(function () {
        dataTable.ajax.reload();
    });

    //Selecting Accounting Data
    $(document).on('click', 'button[name="btnUpdateAccounting"]', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '../scripts/php/Accounting/PurchaseRequest/selectData.php',
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                $('#accountingModal').modal('show');
                $('button[name="btnSubmitAccounting"]').attr("data-dismiss", "modal");
                $("input[name='getIdAccounting']").val(id);
                $("input[name='dateReceivedAccounting']").val(data.dateReceivedAccounting);
                $("select[name='receivedByAccounting']").val(data.receivedByAccounting);
                $("select[name='statusAccounting']").val(data.statusAccounting);
                $("textarea[name='remarksAccounting']").val(data.remarksAccounting);
                $("input[name='releaseDateAccounting']").val(data.releaseDateAccounting);
            },
            error: function () {
                alert("There is an error");
            }
        });
    });

    //Submitting Accounting Data
    $(document).on('click', 'button[name="btnSubmitAccounting"]', function () {
        var id = $('input[name="getIdAccounting"]').val();
        var dateReceivedAccounting = $('input[name="dateReceivedAccounting"]').val();
        var receivedByAccounting = $('select[name="receivedByAccounting"]').val();
        var statusAccounting = $('select[name="statusAccounting"]').val();
        var releaseDateAccounting = $('input[name="releaseDateAccounting"]').val();
        var remarksAccounting = $('textarea[name="remarksAccounting"]').val();
        if (dateReceivedAccounting != "" && receivedByAccounting != "" && statusAccounting != "") {
            $.ajax({
                url: "../scripts/php/Accounting/PurchaseRequest/updateData.php",
                method: "POST",
                data: {
                    id: id,
                    dateReceivedAccounting: dateReceivedAccounting,
                    receivedByAccounting: receivedByAccounting,
                    statusAccounting: statusAccounting,
                    releaseDateAccounting: releaseDateAccounting,
                    remarksAccounting: remarksAccounting
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                },
                error: function () {
                    alert("There is an error!");
                }
            });
        } else {
            alert("There are still empty fields!");
        }
    });

    // For Delete
    $(document).on("click", "button[name='btnDeleteAccounting']", function () {
        var id = $(this).attr("id");
        if (confirm('Are you sure you want to remove this data?')) {
            $.ajax({
                url: "../scripts/php/Accounting/PurchaseRequest/deleteData.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        } else {
            return false;
        }
    });
});