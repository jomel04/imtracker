$(document).ready(function () {
    //Fetching Data
    var dataTable = $('#expenseAccount').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/Settings/ExpenseAccount/fetchData.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true
    });

    //Adding data-dismiss to button[name="expenseAccountBtnSubmit"]
    $("input[name='expenseAccount']").change(function () {
        if ($(this).val() != "") {
            $('button[name="expenseAccountBtnSubmit"]').attr("data-dismiss", "modal");
        } else {
            $('button[name="expenseAccountBtnSubmit"]').removeAttr("data-dismiss");
        }
    });
    //Adding new record
    $(document).on('click', '#btnAddExpenseAccount', function () {
        $('#expenseAccountForm')[0].reset();
        $("input[name='action']").val("Insert");
        $('button[name="expenseAccountBtnSubmit"]').removeAttr('data-dismiss');
        $("button[name='expenseAccountBtnUpdate']").attr('name', 'expenseAccountBtnSubmit').text("ADD").removeAttr('data-dismiss');
    });

    //Submitting form (INSERTING DATA)
    $(document).on('click', 'button[name="expenseAccountBtnSubmit"]', function () {
        //Get ID
        var id = $("input[name='getExpenseAccountId']").val();
        //Data
        var expenseAccount = $("input[name='expenseAccount']").val();

        var action = $("input[name='action']").val();
        if (expenseAccount != "") {
            $.ajax({
                url: "../scripts/php/Settings/ExpenseAccount/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    expenseAccount: expenseAccount
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        }
    });

    //Selecting Data
    $(document).on('click', 'button[name="expenseAccountBtnSelect"]', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: "../scripts/php/Settings/ExpenseAccount/selectData.php",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                $("#expenseAccountModal").modal("show");
                $("input[name='action']").val("Update");
                $("input[name='getExpenseAccountId']").val(id);
                $("button[name='expenseAccountBtnSubmit']").attr('name', 'expenseAccountBtnUpdate').text("UPDATE");
                $("button[name='expenseAccountBtnUpdate']").attr('data-dismiss', 'modal');
                $('input[name="expenseAccount"]').val(data.name.type);
            }
        });
    });

    //Updating Data
    $(document).on('click', 'button[name="expenseAccountBtnUpdate"]', function () {
        //Get ID
        var id = $("input[name='getExpenseAccountId']").val();
        //Data
        var expenseAccount = $("input[name='expenseAccount']").val();
        var action = $("input[name='action']").val();
        if (expenseAccount != "") {
            $.ajax({
                url: "../scripts/php/Settings/ExpenseAccount/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    expenseAccount: expenseAccount
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        } else {
            alert('Please fill out the field');
        }
    });

    //Deleting Data
    $(document).on('click', 'button[name="expenseAccountBtnDelete"]', function () {
        var id = $(this).attr("id");
        if (confirm('Are you sure you want to delete this data?')) {
            $.ajax({
                url: "../scripts/php/Settings/ExpenseAccount/deleteData.php",
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