$(document).ready(function () {
    //Fetching Data
    var dataTable = $("#purchaseRequest").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/PurchaseRequest/fetchData.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true,
        "pagingType": "full_numbers"
    });
    $("button[name='btnAdd']").click(function () {
        $("#purchaseRequestForm")[0].reset();
        $('button[name="purchaseRequestbtnSubmit"]').removeAttr("data-dismiss", "modal");
        $("input[name='action']").val("Insert");
        $("button[name='purchaseRequestbtnSubmit']").text("ADD");
        $("input[name='dateCreated']").prop("disabled", false);
        $("input[name='refNo']").prop("disabled", false);
        $("select[name='expenseAccount']").prop("disabled", false);
        $("select[name='section']").prop("disabled", false);
        $("select[name='requestor']").prop("disabled", false);
        $("select[name='chargeTo']").prop("disabled", false);
    });
    //Inserting to Database
    $(document).on("click", "button[name='purchaseRequestbtnSubmit']", function () {
        //Get ID
        var id = $("input[name='getIdPurchaseRequest']").val();
        //Data
        var dateCreated = $("input[name='dateCreated']").val();
        var refNo = $("input[name='refNo']").val();
        var expenseAccount = $("select[name='expenseAccount']").val();
        var section = $("select[name='section']").val();
        var requestor = $("select[name='requestor']").val();
        var purpose = $("textarea[name='purpose']").val();
        var purchaseRequestRemarks = $("textarea[name='purchaseRequestRemarks']").val();
        var cost = $("input[name='cost']").val();
        var chargeTo = $("select[name='chargeTo']").val();

        var dateReceived = $("input[name='dateReceived']").val();
        var status = $("select[name='status']").val();
        var dateApproved = $("input[name='dateApproved']").val();
        var managerRemarks = $("textarea[name='managerRemarks']").val();
        var action = $("input[name='action']").val();
        if (dateCreated != "" && refNo != "" && expenseAccount != "" && section != "" && requestor != "" && chargeTo != "" && dateReceived != "" && status != "" && dateApproved != "") {
            $.ajax({
                url: "../scripts/php/PurchaseRequest/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    dateCreated: dateCreated,
                    refNo: refNo,
                    expenseAccount: expenseAccount,
                    section: section,
                    requestor: requestor,
                    cost: cost,
                    chargeTo: chargeTo,
                    purpose: purpose,
                    purchaseRequestRemarks: purchaseRequestRemarks,
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
        $("#purchaseRequestForm")[0].reset();
    });

    //For Update
    $(document).on("click", "button[name='btnUpdate']", function () {
        var id = $(this).attr("id");
        $.ajax({
            url: "../scripts/php/PurchaseRequest/selectData.php",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                $("#purchaseRequestModal").modal("show");
                $("input[name='action']").val("Update");
                $("input[name='getIdPurchaseRequest']").val(id);
                $("button[name='purchaseRequestbtnSubmit']").text("UPDATE");
                $('button[name="purchaseRequestbtnSubmit"]').attr("data-dismiss", "modal");
                $("input[name='dateCreated']").val(data.dateCreated).prop("disabled", true);
                $("input[name='refNo']").val(data.refNo).prop("disabled", true);
                $("select[name='expenseAccount']").val(data.expenseAccount.expenseID).prop("disabled", true);
                $("select[name='section']").val(data.section.sectionID).prop("disabled", true);
                $("select[name='requestor']").val(data.requestor).prop("disabled", true);
                $("input[name='cost']").val(data.cost);
                $("select[name='chargeTo']").val(data.chargeTo).prop("disabled", true);
                $("textarea[name='purpose']").val(data.purpose);
                $("textarea[name='purchaseRequestRemarks']").val(data.remarks);
                $("input[name='dateReceived']").val(data.dateReceived);
                $("select[name='status']").val(data.status);
                $("input[name='dateApproved']").val(data.dateApproved);
                $("textarea[name='managerRemarks']").val(data.managerRemarks);
            },
            error: function () {
                alert("There is an error!");
            }
        })
    });

    //For Delete
    $(document).on("click", "button[name='btnDelete']", function () {
        var id = $(this).attr("id");
        if (confirm('Are you sure you want to remove this data?')) {
            $.ajax({
                url: "../scripts/php/PurchaseRequest/deleteData.php",
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