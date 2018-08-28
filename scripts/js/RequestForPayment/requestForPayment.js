$(document).ready(function() {
    //Fetching Data
    var dataTable = $("#requestForPayment").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/RequestForPayment/requestForPaymentFetchData.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true,
        "pagingType": "full_numbers"
    });
    $("button[name='btnAdd']").click(function() {
        $("#requestForPaymentForm")[0].reset();
        $('button[name="requestForPaymentbtnSubmit"]').removeAttr("data-dismiss", "modal");
        $("input[name='action']").val("Insert");
        $("button[name='requestForPaymentbtnSubmit']").text("ADD");
        $("input[name='dateCreated']").prop("disabled", false);
        $("select[name='expenseAccount']").prop("disabled", false);
        $("select[name='section']").prop("disabled", false);
        $("select[name='requestor']").prop("disabled", false);
        $("select[name='payee']").prop("disabled", false);
    });
    //Inserting to Database
    $(document).on("click", "button[name='requestForPaymentbtnSubmit']", function() {
        //Get ID
        var id = $("input[name='getIdRequestForPayment']").val();
        //Data
        var dateCreated = $("input[name='dateCreated']").val();
        var expenseAccount = $("select[name='expenseAccount']").val();
        var section = $("select[name='section']").val();
        var requestor = $("select[name='requestor']").val();
        var payee = $("select[name='payee']").val();
        var purpose = $("textarea[name='purpose']").val();
        var requestForPaymentRemarks = $("textarea[name='requestForPaymentRemarks']").val();
        var cost = $("input[name='cost']").val();

        var dateReceived = $("input[name='dateReceived']").val();
        var status = $("select[name='status']").val();
        var dateApproved = $("input[name='dateApproved']").val();
        var managerRemarks = $("textarea[name='managerRemarks']").val();
        var action = $("input[name='action']").val();
        if (dateCreated != "" && expenseAccount != "" && section != "" && requestor != "" && payee != "") {
            $.ajax({
                url: "../scripts/php/RequestForPayment/requestForPaymentInsertData.php",
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
                success: function(data) {
                    alert(data);
                    dataTable.ajax.reload();
                },
                error: function() {
                    alert("There is an error!");
                }
            });
        }
    });
    $(document).on("click", "#btnClose", function() {
        $("#requestForPaymentForm")[0].reset();
    });

    //For Delete
    $(document).on("click", "button[name='btnDelete']", function() {
        var id = $(this).attr("id");
    });

    //For Update
    $(document).on("click", "button[name='btnUpdate']", function() {
        var id = $(this).attr("id");
        $.ajax({
            url: "../scripts/php/RequestForPayment/requestForPaymentSelectData.php",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $("#requestForPaymentModal").modal("show");
                $("input[name='action']").val("Update");
                $("input[name='getIdRequestForPayment']").val(id);
                $("button[name='requestForPaymentbtnSubmit']").text("UPDATE");
                $('button[name="requestForPaymentbtnSubmit"]').attr("data-dismiss", "modal");
                $("input[name='dateCreated']").val(data.dateCreated).prop("disabled", true);
                $("select[name='expenseAccount']").val(data.expenseAccount.expenseID).prop("disabled", true);
                $("select[name='section']").val(data.section.sectionID).prop("disabled", true);
                $("select[name='requestor']").val(data.requestor).prop("disabled", true);
                $("select[name='payee']").val(data.payee).prop("disabled", true);
                $("textarea[name='purpose']").val(data.purpose);
                $("textarea[name='requestForPaymentRemarks']").val(data.remarks);
                $("input[name='cost']").val(data.cost);
                $("input[name='dateReceived']").val(data.dateReceived);
                $("select[name='status']").val(data.status);
                $("input[name='dateApproved']").val(data.dateApproved);
                $("textarea[name='managerRemarks']").val(data.managerRemarks);
            },
            error: function() {
                alert("There is an error!");
            }
        })
    });
});