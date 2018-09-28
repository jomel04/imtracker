$(document).ready(function () {
    //Fetching Data
    var dataTable = $("#requestForPayment").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/RequestForPayment/fetchData.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true
    });

    //For Selecting Status
    /* --------------------------------------------------------------------------- */
    $("select[name='status']").change(function () {
        if (this.value != 'Approved') {
            $('span.costRequired').text('');
            $('span.dateRequestForPayment').text('');
            $("input[name='dateReceived']").prop('disabled', true).val('');
            $("input[name='dateApproved']").prop('disabled', true).val('');
            $('button[name="requestForPaymentbtnSubmit"]').removeAttr("data-dismiss").removeAttr('disabled');
            $('button[name="requestForPaymentbtnUpdate"]').removeAttr("data-dismiss").removeAttr('disabled');
        } else {
            $('button[name="requestForPaymentbtnUpdate"]').prop('disabled', true);
            $('button[name="requestForPaymentbtnSubmit"]').prop('disabled', true);
            if ($("input[name='cost']").val() == 0.00) {
                $('span.costRequired').text('(Please fill out this field)');
            }
            $("input[name='dateReceived']").removeAttr('disabled').attr('required', true);
            $("input[name='dateApproved']").removeAttr('disabled').attr('required', true);
            $('span.dateRequestForPayment').text('(Please fill out this field)');
        }
    });
    $("input[name='cost'], input[name='dateReceived'], input[name='dateApproved']").change(function () {
        if ($("input[name='cost']").val() != 0.00 && $("input[name='dateReceived']").val() != "" && $("input[name='dateApproved']").val() != "") {
            $('span.costRequired').text('');
            $('span.dateRequestForPayment').text('');
            $('button[name="requestForPaymentbtnUpdate"]').attr("data-dismiss", "modal").removeAttr('disabled');
            $('button[name="requestForPaymentbtnSubmit"]').attr("data-dismiss", "modal").removeAttr('disabled');
        }
    });
    /* --------------------------------------------------------------------------- */

    //Add new record
    $("button[name='btnAdd']").click(function () {
        $("#requestForPaymentForm")[0].reset();
        $("input[name='action']").val("Insert");
        $('button[name="requestForPaymentbtnUpdate"]').attr("name", "requestForPaymentbtnSubmit");
        $('button[name="requestForPaymentbtnSubmit"]').removeAttr("data-dismiss").text("ADD");
        $("input[name='dateCreated']").prop("disabled", false);
        $("select[name='expenseAccount']").prop("disabled", false);
        $("select[name='section']").prop("disabled", false);
        $("select[name='requestor']").prop("disabled", false);
        $("input[name='payee']").prop("disabled", false);
        $("input[name='dateReceived']").prop('disabled', true);
        $("input[name='dateApproved']").prop('disabled', true);
        $('span.costRequired').text('');
        $('span.dateRequestForPayment').text('');
    });

    //Inserting Data
    $(document).on("click", "button[name='requestForPaymentbtnSubmit']", function () {
        //Get ID
        var id = $("input[name='getIdRequestForPayment']").val();
        //Data
        var dateCreated = $("input[name='dateCreated']").val();
        var expenseAccount = $("select[name='expenseAccount']").val();
        var section = $("select[name='section']").val();
        var requestor = $("select[name='requestor']").val();
        var payee = $("input[name='payee']").val();
        var purpose = $("textarea[name='purpose']").val();
        var requestForPaymentRemarks = $("textarea[name='requestForPaymentRemarks']").val();
        var cost = $("input[name='cost']").val();

        var dateReceived = $("input[name='dateReceived']").val();
        var status = $("select[name='status']").val();
        var dateApproved = $("input[name='dateApproved']").val();
        var managerRemarks = $("textarea[name='managerRemarks']").val();
        var action = $("input[name='action']").val();
        if (dateCreated != "" && expenseAccount != "" && section != "" && requestor != "" && payee != "" && dateReceived != "" && status != "" && dateApproved != "") {
            $.ajax({
                url: "../scripts/php/RequestForPayment/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    dateCreated: dateCreated,
                    expenseAccount: expenseAccount,
                    section: section,
                    requestor: requestor,
                    payee: payee,
                    purpose: purpose,
                    requestForPaymentRemarks: requestForPaymentRemarks,
                    cost: cost,
                    dateReceived: dateReceived,
                    status: status,
                    dateApproved: dateApproved,
                    managerRemarks: managerRemarks
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        } else if (dateCreated != "" && expenseAccount != "" && section != "" && requestor != "" && payee != "" && status != "") {
            $.ajax({
                url: "../scripts/php/RequestForPayment/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    dateCreated: dateCreated,
                    expenseAccount: expenseAccount,
                    section: section,
                    requestor: requestor,
                    payee: payee,
                    purpose: purpose,
                    requestForPaymentRemarks: requestForPaymentRemarks,
                    cost: cost,
                    dateReceived: dateReceived,
                    status: status,
                    dateApproved: dateApproved,
                    managerRemarks: managerRemarks
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        }
    });

    //Updating Data
    $(document).on("click", "button[name='requestForPaymentbtnUpdate']", function () {
        //Get ID
        var id = $("input[name='getIdRequestForPayment']").val();
        //Data
        var purpose = $("textarea[name='purpose']").val();
        var requestForPaymentRemarks = $("textarea[name='requestForPaymentRemarks']").val();
        var cost = $("input[name='cost']").val();

        var dateReceived = $("input[name='dateReceived']").val();
        var status = $("select[name='status']").val();
        var dateApproved = $("input[name='dateApproved']").val();
        var managerRemarks = $("textarea[name='managerRemarks']").val();

        var action = $("input[name='action']").val();
        if (status == "Approved" && dateReceived != "" && dateApproved != "") {
            $.ajax({
                url: "../scripts/php/RequestForPayment/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    purpose: purpose,
                    requestForPaymentRemarks: requestForPaymentRemarks,
                    cost: cost,
                    dateReceived: dateReceived,
                    status: status,
                    dateApproved: dateApproved,
                    managerRemarks: managerRemarks
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        } else if (status != "Approved") {
            $.ajax({
                url: "../scripts/php/RequestForPayment/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    purpose: purpose,
                    requestForPaymentRemarks: requestForPaymentRemarks,
                    cost: cost,
                    dateReceived: dateReceived,
                    status: status,
                    dateApproved: dateApproved,
                    managerRemarks: managerRemarks
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        }
    });

    $(document).on("click", "#btnClose", function () {
        $("#requestForPaymentForm")[0].reset();
    });

    //For Selecting Data
    $(document).on("click", "button[name='btnSelect']", function () {
        var id = $(this).attr("id");
        $.ajax({
            url: "../scripts/php/RequestForPayment/selectData.php",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                $("#requestForPaymentModal").modal("show");
                $("input[name='action']").val("Update");
                $("input[name='getIdRequestForPayment']").val(id);
                $("button[name='requestForPaymentbtnSubmit']").attr('name', 'requestForPaymentbtnUpdate').text("UPDATE");
                $('button[name="requestForPaymentbtnUpdate"]').removeAttr("data-dismiss");
                $("input[name='dateCreated']").val(data.dateCreated).prop("disabled", true);
                $("select[name='expenseAccount']").val(data.expenseAccount.expenseID).prop("disabled", true);
                $("select[name='section']").val(data.section.sectionID).prop("disabled", true);
                $("select[name='requestor']").val(data.requestor).prop("disabled", true);
                $("input[name='payee']").val(data.payee).prop("disabled", true);
                $("textarea[name='purpose']").val(data.purpose);
                $("textarea[name='requestForPaymentRemarks']").val(data.remarks);
                $("input[name='cost']").val(data.cost);
                $("input[name='dateReceived']").val(data.dateReceived).prop('disabled', true);
                $("select[name='status']").val(data.status);
                $("input[name='dateApproved']").val(data.dateApproved).prop('disabled', true);
                $("textarea[name='managerRemarks']").val(data.managerRemarks);
            }
        })
    });

    //For Delete
    $(document).on("click", "button[name='btnDelete']", function () {
        var id = $(this).attr("id");
        if (confirm('Are you sure you want to remove this data?')) {
            $.ajax({
                url: "../scripts/php/RequestForPayment/deleteData.php",
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