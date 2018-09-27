$(document).ready(function () {
    //Fetching Data
    var dataTable = $('#section').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../scripts/php/Settings/Section/fetchData.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        "stateSave": true
    });

    //Adding data-dismiss to button[name="sectionBtnSubmit"]
    $("input[name='sectionName']").change(function () {
        if ($(this).val() != "") {
            $('button[name="sectionBtnSubmit"]').attr("data-dismiss", "modal");
        } else {
            $('button[name="sectionBtnSubmit"]').removeAttr("data-dismiss");
        }
    });
    //Adding new record
    $(document).on('click', '#btnAddSection', function () {
        $('#sectionForm')[0].reset();
        $("input[name='action']").val("Insert");
        $('button[name="sectionBtnSubmit"]').removeAttr('data-dismiss');
        $("button[name='sectionBtnUpdate']").attr('name', 'sectionBtnSubmit').text("ADD").removeAttr('data-dismiss');
    });

    //Submitting form (INSERTING DATA)
    $(document).on('click', 'button[name="sectionBtnSubmit"]', function () {
        //Get ID
        var id = $("input[name='getSectionId']").val();
        //Data
        var sectionName = $("input[name='sectionName']").val();

        var action = $("input[name='action']").val();
        if (sectionName != "") {
            $.ajax({
                url: "../scripts/php/Settings/Section/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    sectionName: sectionName
                },
                success: function (data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        }
    });

    //Selecting Data
    $(document).on('click', 'button[name="sectionBtnSelect"]', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: "../scripts/php/Settings/Section/selectData.php",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                $("#sectionModal").modal("show");
                $("input[name='action']").val("Update");
                $("input[name='getSectionId']").val(id);
                $("button[name='sectionBtnSubmit']").attr('name', 'sectionBtnUpdate').text("UPDATE");
                $("button[name='sectionBtnUpdate']").attr('data-dismiss', 'modal');
                $('input[name="sectionName"]').val(data.name.type);
            }
        });
    });

    //Updating Data
    $(document).on('click', 'button[name="sectionBtnUpdate"]', function () {
        //Get ID
        var id = $("input[name='getSectionId']").val();
        //Data
        var sectionName = $("input[name='sectionName']").val();
        var action = $("input[name='action']").val();
        if (sectionName != "") {
            $.ajax({
                url: "../scripts/php/Settings/Section/insertData.php",
                method: "POST",
                data: {
                    id: id,
                    action: action,
                    sectionName: sectionName
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
    $(document).on('click', 'button[name="sectionBtnDelete"]', function () {
        var id = $(this).attr("id");
        if (confirm('Are you sure you want to delete this data?')) {
            $.ajax({
                url: "../scripts/php/Settings/Section/deleteData.php",
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