$(document).ready(function () {
    //Fetching Data
    var dataTable = $('#department').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/Settings/Department/fetchData.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true,
        "pagingType": "full_numbers"
    });

    //Adding data-dismiss to button[name="departmentBtnSubmit"]
    $("input[name='departmentName']").change(function () {
        if ($(this).val() != "") {
            $('button[name="departmentBtnSubmit"]').attr("data-dismiss", "modal");
        } else {
            $('button[name="departmentBtnSubmit"]').removeAttr("data-dismiss");
        }
    });
    //Adding new record
    $(document).on('click', '#btnAddDepartment', function () {
        $('#departmentForm')[0].reset();
        $("input[name='action']").val("Insert");
        $('button[name="departmentBtnSubmit"]').removeAttr('data-dismiss');
        $("button[name='departmentBtnUpdate']").attr('name', 'departmentBtnSubmit').text("ADD").removeAttr('data-dismiss');
    });

    //Submitting form (INSERTING DATA)
    $(document).on('click', 'button[name="departmentBtnSubmit"]', function () {
        //Get ID
        var id = $("input[name='getDepartmentId']").val();
        //Data
        var departmentName = $("input[name='departmentName']").val();

        var action = $("input[name='action']").val();
        if (departmentName != "") {
            $.ajax({
                url: "../scripts/php/Settings/Department/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    departmentName: departmentName
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        }
    });

    //Selecting Data
    $(document).on('click', 'button[name="departmentBtnSelect"]', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: "../scripts/php/Settings/Department/selectData.php",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                $("#departmentModal").modal("show");
                $("input[name='action']").val("Update");
                $("input[name='getDepartmentId']").val(id);
                $("button[name='departmentBtnSubmit']").attr('name', 'departmentBtnUpdate').text("UPDATE");
                $("button[name='departmentBtnUpdate']").attr('data-dismiss', 'modal');
                $('input[name="departmentName"]').val(data.name.name);
            }
        });
    });

    //Updating Data
    $(document).on('click', 'button[name="departmentBtnUpdate"]', function () {
        //Get ID
        var id = $("input[name='getDepartmentId']").val();
        //Data
        var departmentName = $("input[name='departmentName']").val();
        var action = $("input[name='action']").val();
        if (departmentName != "") {
            $.ajax({
                url: "../scripts/php/Settings/Department/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    departmentName: departmentName
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
    $(document).on('click', 'button[name="departmentBtnDelete"]', function () {
        var id = $(this).attr("id");
        if (confirm('Are you sure you want to delete this data?')) {
            $.ajax({
                url: "../scripts/php/Settings/Department/deleteData.php",
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