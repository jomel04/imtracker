$(document).ready(function () {
    //Fetching Accounting Data
    var dataTable = $('#accounting').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/Accounting/PurchaseRequest/fetchData.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true
    });

    //Reload AJAX
    $('.accountingTab').click(function () {
        dataTable.ajax.reload();
    });

    //For Selecting Status
    $('select[name="statusAccounting"]').change(function () {
        if (this.value != "Released") {
            $("input[name='dateReceivedAccounting']").removeAttr("disabled");
            $("select[name='receivedByAccounting']").removeAttr("disabled");
            $("input[name='releaseDateAccounting']").prop("disabled", true);
            $('span.releaseDateAccounting').text('');
        } else {
            $("input[name='dateReceivedAccounting']").removeAttr("disabled");
            $("select[name='receivedByAccounting']").removeAttr("disabled");
            $("input[name='releaseDateAccounting']").removeAttr("disabled").focus();
            $('button[name="btnSubmitAccounting"]').removeAttr("data-dismiss").attr('disabled', true);
            $('span.releaseDateAccounting').text('(Please fill out this field)');
        }
    });
    $("input[name='dateReceivedAccounting'], select[name='receivedByAccounting'], input[name='releaseDateAccounting']").change(function () {
        if ($("input[name='dateReceivedAccounting']").val() != "" && $("select[name='statusAccounting']").val() != "" && $("select[name='receivedByAccounting']").val() != "" || $("input[name='releaseDateAccounting']").val() != "") {
            $('span.releaseDateAccounting').text('');
            $('button[name="btnSubmitAccounting"]').attr("data-dismiss", "modal").removeAttr('disabled');
        } else {
            $('button[name="btnSubmitAccounting"]').removeAttr("data-dismiss").attr('disabled', true);
        }
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
                $("input[name='getIdAccounting']").val(id);
                $("input[name='dateReceivedAccounting']").val(data.dateReceivedAccounting).attr('disabled', true);
                $("select[name='receivedByAccounting']").val(data.receivedByAccounting).attr('disabled', true);
                $("select[name='statusAccounting']").val(data.statusAccounting);
                $("textarea[name='remarksAccounting']").val(data.remarksAccounting);
                $("input[name='releaseDateAccounting']").val(data.releaseDateAccounting).attr('disabled', true);
                if (data.statusAccounting != "") {
                    $('button[name="btnSubmitAccounting"]').attr("data-dismiss", "modal");
                }
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
        if (dateReceivedAccounting != "" && receivedByAccounting != "" && statusAccounting != "" && releaseDateAccounting != "") {
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
                    $('button[name="btnSubmitAccounting"]').removeAttr("data-dismiss");
                }
            });
        } else if (dateReceivedAccounting != "" && receivedByAccounting != "" && statusAccounting != "") {
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
                    $('button[name="btnSubmitAccounting"]').removeAttr("data-dismiss");
                }
            });
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