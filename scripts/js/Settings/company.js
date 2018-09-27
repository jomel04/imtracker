$(document).ready(function () {
    //Fetching Data
    var dataTable = $('#company').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/Settings/Company/fetchData.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true
    });

    //Adding data-dismiss to button[name="companyBtnSubmit"]
    $("input[name='companyName']").change(function () {
        if ($(this).val() != "") {
            $('button[name="companyBtnSubmit"]').attr("data-dismiss", "modal");
        } else {
            $('button[name="companyBtnSubmit"]').removeAttr("data-dismiss");
        }
    });
    //Adding new record
    $(document).on('click', '#btnAddCompany', function () {
        $('#companyForm')[0].reset();
        $("input[name='action']").val("Insert");
        $('button[name="companyBtnSubmit"]').removeAttr('data-dismiss');
        $("button[name='companyBtnUpdate']").attr('name', 'companyBtnSubmit').text("ADD").removeAttr('data-dismiss');
    });

    //Submitting form (INSERTING DATA)
    $(document).on('click', 'button[name="companyBtnSubmit"]', function () {
        //Get ID
        var id = $("input[name='getCompanyId']").val();
        //Data
        var companyName = $("input[name='companyName']").val();

        var action = $("input[name='action']").val();
        if (companyName != "") {
            $.ajax({
                url: "../scripts/php/Settings/Company/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    companyName: companyName
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        }
    });

    //Selecting Data
    $(document).on('click', 'button[name="companyBtnSelect"]', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: "../scripts/php/Settings/Company/selectData.php",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                $("#companyModal").modal("show");
                $("input[name='action']").val("Update");
                $("input[name='getCompanyId']").val(id);
                $("button[name='companyBtnSubmit']").attr('name', 'companyBtnUpdate').text("UPDATE");
                $("button[name='companyBtnUpdate']").attr('data-dismiss', 'modal');
                $('input[name="companyName"]').val(data.name.name);
            }
        });
    });

    //Updating Data
    $(document).on('click', 'button[name="companyBtnUpdate"]', function () {
        //Get ID
        var id = $("input[name='getCompanyId']").val();
        //Data
        var companyName = $("input[name='companyName']").val();
        var action = $("input[name='action']").val();
        if (companyName != "") {
            $.ajax({
                url: "../scripts/php/Settings/Company/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    companyName: companyName
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
    $(document).on('click', 'button[name="companyBtnDelete"]', function () {
        var id = $(this).attr("id");
        if (confirm('Are you sure you want to delete this data?')) {
            $.ajax({
                url: "../scripts/php/Settings/Company/deleteData.php",
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