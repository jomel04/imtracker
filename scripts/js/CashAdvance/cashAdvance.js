$(document).ready(function () {
    //Fetching Data
    var dataTable = $("#cashAdvance").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/CashAdvance/fetchData.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true,
        "pagingType": "full_numbers"
    });

    //For Selecting Status
    /* --------------------------------------------------------------------------- */
    $("select[name='status']").change(function () {
        if (this.value != 'Approved') {
            $('span.costRequired').text('');
            $('span.dateCashAdvance').text('');
            $("input[name='dateReceived']").prop('disabled', true).val('');
            $("input[name='dateApproved']").prop('disabled', true).val('');
            $('button[name="cashAdvancebtnSubmit"]').removeAttr("data-dismiss").removeAttr('disabled');
            $('button[name="cashAdvancebtnUpdate"]').removeAttr("data-dismiss").removeAttr('disabled');
        } else {
            if ($("input[name='cost']").val() == 0.00) {
                $('button[name="cashAdvancebtnUpdate"]').prop('disabled', true);
                $('button[name="cashAdvancebtnSubmit"]').prop('disabled', true);
                $('span.costRequired').text('(Please fill out this field)');
            }
            $("input[name='dateReceived']").removeAttr('disabled').attr('required', true);
            $("input[name='dateApproved']").removeAttr('disabled').attr('required', true);
            $('span.dateCashAdvance').text('(Please fill out this field)');
        }
    });
    $("input[name='cost'], input[name='dateReceived'], input[name='dateApproved']").change(function () {
        if ($("input[name='cost']").val() != 0.00 && $("input[name='dateReceived']").val() != "" && $("input[name='dateApproved']").val() != "") {
            $('span.costRequired').text('');
            $('span.dateCashAdvance').text('');
            $('button[name="cashAdvancebtnUpdate"]').attr("data-dismiss", "modal").removeAttr('disabled');
            $('button[name="cashAdvancebtnSubmit"]').attr("data-dismiss", "modal").removeAttr('disabled');
        }
    });
    /* --------------------------------------------------------------------------- */

    // Add new record
    $("button[name='btnAdd']").click(function () {
        $("#cashAdvanceForm")[0].reset();
        $("input[name='action']").val("Insert");
        $("button[name='cashAdvancebtnUpdate']").attr('name', 'cashAdvancebtnSubmit');
        $('button[name="cashAdvancebtnSubmit"]').removeAttr("data-dismiss").text("ADD");
        $("input[name='dateCreated']").prop("disabled", false);
        $("select[name='expenseAccount']").prop("disabled", false);
        $("select[name='section']").prop("disabled", false);
        $("select[name='requestor']").prop("disabled", false);
        $("input[name='dateReceived']").prop('disabled', true);
        $("input[name='dateApproved']").prop('disabled', true);
        $('span.costRequired').text('');
        $('span.dateCashAdvance').text('');
    });

    //Inserting Data
    $(document).on("click", "button[name='cashAdvancebtnSubmit']", function () {
        //Get ID
        var id = $("input[name='getIdCashAdvance']").val();
        //Data
        var dateCreated = $("input[name='dateCreated']").val();
        var expenseAccount = $("select[name='expenseAccount']").val();
        var section = $("select[name='section']").val();
        var requestor = $("select[name='requestor']").val();
        var purpose = $("textarea[name='purpose']").val();
        var cashAdvanceRemarks = $("textarea[name='cashAdvanceRemarks']").val();
        var cost = $("input[name='cost']").val();

        var dateReceived = $("input[name='dateReceived']").val();
        var status = $("select[name='status']").val();
        var dateApproved = $("input[name='dateApproved']").val();
        var managerRemarks = $("textarea[name='managerRemarks']").val();
        var action = $("input[name='action']").val();
        if (dateCreated != "" && expenseAccount != "" && section != "" && requestor != "" && status != "" && dateReceived != "" && dateApproved != "") {
            $.ajax({
                url: "../scripts/php/CashAdvance/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    dateCreated: dateCreated,
                    expenseAccount: expenseAccount,
                    section: section,
                    requestor: requestor,
                    purpose: purpose,
                    cashAdvanceRemarks: cashAdvanceRemarks,
                    cost: cost,
                    dateReceived: dateReceived,
                    status: status,
                    dateApproved: dateApproved,
                    managerRemarks: managerRemarks
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                },
                error: function () {
                    alert("There is an error!");
                }
            });
        } else if (dateCreated != "" && expenseAccount != "" && section != "" && requestor != "" && status != "") {
            $.ajax({
                url: "../scripts/php/CashAdvance/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    dateCreated: dateCreated,
                    expenseAccount: expenseAccount,
                    section: section,
                    requestor: requestor,
                    purpose: purpose,
                    cashAdvanceRemarks: cashAdvanceRemarks,
                    cost: cost,
                    dateReceived: dateReceived,
                    status: status,
                    dateApproved: dateApproved,
                    managerRemarks: managerRemarks
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                },
                error: function () {
                    alert("There is an error!");
                }
            });
        }
    });

    //Updating Data
    $(document).on("click", "button[name='cashAdvancebtnUpdate']", function () {
        //Get ID
        var id = $("input[name='getIdCashAdvance']").val();
        //Data
        var purpose = $("textarea[name='purpose']").val();
        var cashAdvanceRemarks = $("textarea[name='cashAdvanceRemarks']").val();
        var cost = $("input[name='cost']").val();

        var dateReceived = $("input[name='dateReceived']").val();
        var status = $("select[name='status']").val();
        var dateApproved = $("input[name='dateApproved']").val();
        var managerRemarks = $("textarea[name='managerRemarks']").val();
        var action = $("input[name='action']").val();
        if (status == "Approved" && dateReceived != "" && dateApproved != "") {
            $.ajax({
                url: "../scripts/php/CashAdvance/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    purpose: purpose,
                    cashAdvanceRemarks: cashAdvanceRemarks,
                    cost: cost,
                    dateReceived: dateReceived,
                    status: status,
                    dateApproved: dateApproved,
                    managerRemarks: managerRemarks
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                },
                error: function () {
                    alert("There is an error!");
                }
            });
        } else if (status != "Approved") {
            $.ajax({
                url: "../scripts/php/CashAdvance/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    purpose: purpose,
                    cashAdvanceRemarks: cashAdvanceRemarks,
                    cost: cost,
                    dateReceived: dateReceived,
                    status: status,
                    dateApproved: dateApproved,
                    managerRemarks: managerRemarks
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                },
                error: function () {
                    alert("There is an error!");
                }
            });
        }
    });
    $(document).on("click", "#btnClose", function () {
        $("#cashAdvanceForm")[0].reset();
    });

    //Deleting Data
    $(document).on("click", "button[name='btnDelete']", function () {
        var id = $(this).attr("id");
        if (confirm('Are you sure you want to remove this data?')) {
            $.ajax({
                url: "../scripts/php/CashAdvance/deleteData.php",
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

    //Selecting Data
    $(document).on("click", "button[name='btnSelect']", function () {
        var id = $(this).attr("id");
        $.ajax({
            url: "../scripts/php/CashAdvance/selectData.php",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                $("#cashAdvanceModal").modal("show");
                $("input[name='action']").val("Update");
                $("input[name='getIdCashAdvance']").val(id);
                $("button[name='cashAdvancebtnSubmit']").attr('name', 'cashAdvancebtnUpdate').text("UPDATE");
                $("button[name='cashAdvancebtnUpdate']").removeAttr("data-dismiss");
                $("input[name='dateCreated']").val(data.dateCreated).prop("disabled", true);
                $("select[name='expenseAccount']").val(data.expenseAccount.expenseID).prop("disabled", true);
                $("select[name='section']").val(data.section.sectionID).prop("disabled", true);
                $("select[name='requestor']").val(data.requestor).prop("disabled", true);
                $("textarea[name='purpose']").val(data.purpose);
                $("textarea[name='cashAdvanceRemarks']").val(data.remarks);
                $("input[name='cost']").val(data.cost);
                $("input[name='dateReceived']").val(data.dateReceived).prop('disabled', true);;
                $("select[name='status']").val(data.status);
                $("input[name='dateApproved']").val(data.dateApproved).prop('disabled', true);;
                $("textarea[name='managerRemarks']").val(data.managerRemarks);
            },
            error: function () {
                alert("There is an error!");
            }
        })
    });

    // Show all records
    // $(document).on('click', 'button[name="btnShowAll"]', function () {
    //     var dataTable = $("#cashAdvance").DataTable({
    //         "processing": true,
    //         "serverSide": true,
    //         "order": [],
    //         "ajax": {
    //             url: "../scripts/php/CashAdvance/fetchData.php",
    //             type: "POST"
    //         },
    //         "data": {
    //             showAll: $('button[name="btnShowAll"]')
    //         },
    //         "columnDefs": [{
    //             "targets": [0],
    //             "orderable": false
    //         }],
    //         "stateSave": true,
    //         "pagingType": "full_numbers"
    //     });
    // });
});