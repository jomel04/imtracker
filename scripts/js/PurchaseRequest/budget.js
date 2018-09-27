$(document).ready(function () {
    //Fetching Budget Data
    var dataTable = $('#budget').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/Budget/PurchaseRequest/fetchData.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true
    });

    //Clicking budget tab & reload ajax
    $('.budgetTab').click(function () {
        dataTable.ajax.reload();
    });

    //For Selecting Status
    $('select[name="statusBudget"]').change(function () {
        if (this.value == "Approved" || this.value == "Released") {
            $("select[name='budgeted']").removeAttr("disabled");
            $("input[name='dateReceivedBudget']").removeAttr("disabled");
            $("select[name='receivedByBudget']").removeAttr("disabled");
            $("input[name='dateApprovedBudget']").removeAttr("disabled").focus();
            $('button[name="btnSubmitBudget"]').removeAttr("data-dismiss").attr('disabled', true);
            $('span.dateApprovedBudget').text('(Please fill out this field)');
        } else {
            $("select[name='budgeted']").removeAttr("disabled");
            $("input[name='dateReceivedBudget']").removeAttr("disabled");
            $("select[name='receivedByBudget']").removeAttr("disabled");
            $("input[name='dateApprovedBudget']").prop("disabled", true);
            $('span.dateApprovedBudget').text('');
        }
    });
    $("select[name='budgeted'], input[name='dateReceivedBudget'], select[name='receivedByBudget'], input[name='dateApprovedBudget']").change(function () {
        if ($("select[name='budgeted']").val() != "" && $("input[name='dateReceivedBudget']").val() != "" && $("select[name='statusBudget']").val() != "" && $("select[name='receivedByBudget']").val() != "" || $("input[name='dateApprovedBudget']").val() != "") {
            $('span.dateApprovedBudget').text('');
            $('button[name="btnSubmitBudget"]').attr("data-dismiss", "modal").removeAttr('disabled');
        } else {
            $('button[name="btnSubmitBudget"]').removeAttr("data-dismiss").attr('disabled', true);
        }
    });

    //Selecting Data Budget Data
    $(document).on('click', 'button[name="btnUpdateBudget"]', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '../scripts/php/Budget/PurchaseRequest/selectData.php',
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                $('#budgetModal').modal('show');
                $("input[name='getIdBudget']").val(id);
                $("select[name='budgeted']").val(data.budgeted).prop("disabled", true);
                $("input[name='dateReceivedBudget']").val(data.dateReceivedBudget).prop("disabled", true);
                $("input[name='dateApprovedBudget']").val(data.dateApprovedBudget).prop("disabled", true);
                $("select[name='receivedByBudget']").val(data.receivedByBudget).prop("disabled", true);
                $("select[name='statusBudget']").val(data.statusBudget);
                $("textarea[name='remarksBudget']").val(data.remarksBudget);
                if (data.statusBudget != "") {
                    $('button[name="btnSubmitBudget"]').attr("data-dismiss", "modal");
                }
            }
        });
    });

    //Submitting Accounting Data
    $(document).on('click', 'button[name="btnSubmitBudget"]', function () {
        var id = $('input[name="getIdBudget"]').val();
        var budgeted = $('select[name="budgeted"]').val();
        var dateReceivedBudget = $('input[name="dateReceivedBudget"]').val();
        var dateApprovedBudget = $('input[name="dateApprovedBudget"]').val();
        var receivedByBudget = $('select[name="receivedByBudget"]').val();
        var statusBudget = $('select[name="statusBudget"]').val();
        var remarksBudget = $('textarea[name="remarksBudget"]').val();
        if (budgeted != "" && dateReceivedBudget != "" && dateApprovedBudget != "" && receivedByBudget != "" && statusBudget != "") {
            $.ajax({
                url: "../scripts/php/Budget/PurchaseRequest/updateData.php",
                method: "POST",
                data: {
                    id: id,
                    budgeted: budgeted,
                    dateReceivedBudget: dateReceivedBudget,
                    dateApprovedBudget: dateApprovedBudget,
                    receivedByBudget: receivedByBudget,
                    statusBudget: statusBudget,
                    remarksBudget: remarksBudget
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                    $('button[name="btnSubmitBudget"]').removeAttr("data-dismiss");
                }
            });
        } else if (budgeted != "" && dateReceivedBudget != "" && receivedByBudget != "" && statusBudget != "") {
            $.ajax({
                url: "../scripts/php/Budget/PurchaseRequest/updateData.php",
                method: "POST",
                data: {
                    id: id,
                    budgeted: budgeted,
                    dateReceivedBudget: dateReceivedBudget,
                    dateApprovedBudget: dateApprovedBudget,
                    receivedByBudget: receivedByBudget,
                    statusBudget: statusBudget,
                    remarksBudget: remarksBudget
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                    $('button[name="btnSubmitBudget"]').removeAttr("data-dismiss");
                }
            });
        }
    });

    // For Delete
    $(document).on("click", "button[name='btnDeleteBudget']", function () {
        var id = $(this).attr("id");
        if (confirm('Are you sure you want to remove this data?')) {
            $.ajax({
                url: "../scripts/php/Budget/PurchaseRequest/deleteData.php",
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