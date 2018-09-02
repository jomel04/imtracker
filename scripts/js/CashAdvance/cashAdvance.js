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

    // Add new record
    $("button[name='btnAdd']").click(function () {
        $("#cashAdvanceForm")[0].reset();
        $('button[name="cashAdvancebtnSubmit"]').removeAttr("data-dismiss", "modal");
        $("input[name='action']").val("Insert");
        $("button[name='cashAdvancebtnSubmit']").text("ADD");
        $("input[name='dateCreated']").prop("disabled", false);
        $("select[name='expenseAccount']").prop("disabled", false);
        $("select[name='section']").prop("disabled", false);
        $("select[name='requestor']").prop("disabled", false);
    });
    //Inserting to Database
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
        if (dateCreated != "" && expenseAccount != "" && section != "" && requestor != "" && dateReceived != "" && status != "" && dateApproved != "") {
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
    $(document).on("click", "#btnClose", function () {
        $("#cashAdvanceForm")[0].reset();
    });

    //For Delete
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

    //For Update
    $(document).on("click", "button[name='btnUpdate']", function () {
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
                $("button[name='cashAdvancebtnSubmit']").text("UPDATE");
                $('button[name="cashAdvancebtnSubmit"]').attr("data-dismiss", "modal");
                $("input[name='dateCreated']").val(data.dateCreated).prop("disabled", true);
                $("select[name='expenseAccount']").val(data.expenseAccount.expenseID).prop("disabled", true);
                $("select[name='section']").val(data.section.sectionID).prop("disabled", true);
                $("select[name='requestor']").val(data.requestor).prop("disabled", true);
                $("textarea[name='purpose']").val(data.purpose);
                $("textarea[name='cashAdvanceRemarks']").val(data.remarks);
                $("input[name='cost']").val(data.cost);
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